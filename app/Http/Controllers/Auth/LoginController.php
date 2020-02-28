<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseHelper;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/boton';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function enter(Request $request)
    {
        $user = null;

        $validator = Validator::make($request->all(), [
          'username' => ['required','string', 'max:32', 'min:4'],
          'password' => ['required','string','max:180', 'min:4'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $_request = $request->all();
        $username = $_request['username'];
        $password = $_request['password'];

        /*if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $username, 'password' => $password];
            Auth::attempt($credentials);
        } else {
          $credentials = ['nickname' => $username, 'password' => $password];
          Auth::attempt($credentials);
        }*/

        $credentials = ['username' => $username, 'password' => $password];
        Auth::attempt($credentials);

        /*SI TE LOGRASTE LOGUEAR TE AGARRA EL USUARIO*/
        if ( Auth::check() ) $user = Auth::user();


        /*GENERAMOS EL TOKEN*/
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return ResponseHelper::dinamicError($request, 'Credenciales invalidas', 400);
            }
        } catch (JWTException $e) {
          return ResponseHelper::dinamicError($request, 'No se pudo crear el token', 500);
        }

        if(!$request->ajax()) {
          Auth::login(User::find($user['id']));
          session(['JWT' => $token]);
        }


        if($user['blacklist']){
            $logout = Auth::logout();
            return ResponseHelper::dinamicError($request, 'Usted se encuentra baneado.', 401);
        }

        /*Te logueaste fino*/

        $message = [
          'icon'  => '../statics/hihand.png',
          'title' => 'Excelente!',
          'text'  => 'Bienvenido ' . $request->input('username') . '!',
        ];

        $blacklist = [
          'Matson','matson','matsonwashere','Matsonwashere'
        ];

        if (in_array($request->input('username'),$blacklist)) {
          $message = [
            'icon'  => '../statics/wink.png',
            'title' => 'Hey!',
            'text'  => $request->input('username') . ', jajajaja',
          ];
        }

        if($request->ajax()){
          return response()->json(['user'=>$user,'token'=>$token,'message' => $message]);
        }else return redirect('/boton');

    }

    public function logout()
    {
      Auth::logout();
      return back();
    }

}
