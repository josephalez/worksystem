import Connection from '../../helpers/Connection.js';
import DateHelper from '../../helpers/DateHelper.js';

export async function fetchOrganizations (context) {
  const key = 'organizations';
  const data = await Connection.requestArray(
    'get', context.getters.getUri('api/organizations')
  );
  context.commit('setData',{ key:'organizations' , data: data });
}

export async function fetchOrganization (context, information) {
  const key = 'organization';
  const data = information;
  context.commit('setData',{ key:'organization' , data: data });
}

export async function NewOrganizations(context, formData){
  const getUri  = context.getters.getUri;
  const url     = getUri('api/organizations');
  const request = await Connection.requestFD('POST',url, formData);
  console.log("resultados del request",request);
  return request;//success data
}
export async function OrganizationState(context, formData){
  const getUri  = context.getters.getUri;
  const url     = getUri('api/organizations/state');
  const request = await Connection.request('POST',url, formData);
  console.log("resultados del request",request);
  return request;//success data
}
export async function deleteOrganizations(context, id){
  console.log('En el Action:  ',id);
  const getUri  = context.getters.getUri;
  const url     = getUri('api/organizations/'+id);
  const request = await Connection.request('DELETE',url, id);
  console.log("resultados del request",request);
  return request;//success data
}
export async function login(context, formData){
  const getUri  = context.getters.getUri;
  const url     = getUri('api/login');
  const request = await Connection.request('POST',url, formData);
  console.log("resultados del request",request);
  var data = request.data.user;
  return request;//success data
}
export async function fetchAssistances (context, fecha=null) {
  if (fecha == null){
    var date = (DateHelper.newDate()).getDateComplete();
  }else {
    var date = fecha;
  }
  const key = 'assistances';
  const data = await Connection.requestArray(
    'get', context.getters.getUri('api/assistances/'+ date)
  );
  console.log(data);
  context.commit('setData',{ key:'assistances' , data: data });
}
export async function EntryAssistance(context, assistance){
  const getUri  = context.getters.getUri;
  const url     = getUri('api/assistance');
  const request = await Connection.request('POST',url, assistance);
  console.log("resultados del request",request);
  return request;//success data
}
export async function LeaveAssistance(context, assistance){
  const getUri  = context.getters.getUri;
  const url     = getUri('api/assistance/leave');
  const request = await Connection.request('POST',url, assistance);
  console.log("resultados del request",request);
  return request;//success data
}
