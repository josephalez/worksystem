import qs from "qs";

var headerAuth = {};

export default class Connection {

  static errorMessage(response){
    console.log('PARSE ERROR', response)
    let error = 'Error';

    switch (response.status) { case 500: error = 'Error interno del servidor'; break; }

    if (response.data) {
      let errorJSON = null;
      try {
        errorJSON = JSON.parse(response.data);
      } catch (e) {
        errorJSON = null;
      }

      error = response.data;
      if (errorJSON) error = errorJSON;

    }

    return error;
  }

  static reqFetch(url, method = 'GET', data = null, headers = null){

    if (!headers)
      headers = {
        'Content-Type': 'application/json',
        ...headerAuth
        //'Content-Type': 'application/x-www-form-urlencoded'
      };

    let myInit = { method,
                   headers,
                   mode: 'cors',
                   cache: 'default' };

    //console.log("DATA",data);

    if (data)
      myInit.body = /*JSON.stringify(*/qs.stringify(data)/*)*/;

    var myRequest = new Request(url, myInit);

    return fetch(myRequest).then(async res => {
      /*console.log(res)
      if (res.ok)*/
        /*console.log("RESPONSE",res)
        console.log("AWAIT RESPONSE 2",await res.clone().text());
        console.log("AWAIT RESPONSE 3",await res.clone().json());*/
        try {
          return { ok: res.ok, data: await res.clone().json(), status:res.status };
        } catch (e) {
          console.log("La respuesta no es un JSON");
          console.log('RES');
          console.log("RES", await res.clone());
          console.log('ESTE RES NO DEBERIA SALIR');
          return { ok: false, data: await res.clone().text(), status:res.status };
        }

    })
    .catch(function(error) {
      console.log('Hubo un problema con la petición Fetch:' + error.message);
      throw error.message;
    });

  }

  static reqFormData(url, method = 'GET', data = null, headers = null){

    if (!headers)
      headers = {
        'Content-Type': 'multipart/form-data',
        ...headerAuth
        //'Content-Type': 'application/x-www-form-urlencoded'
      };

    let myInit = { method,
                   headers,
                   mode: 'cors',
                   cache: 'default' };

    //console.log("DATA",data);

    if (data)
      myInit.body = data;

    var myRequest = new Request(url, myInit);

    return fetch(myRequest).then(async res => {
      /*console.log(res)
      if (res.ok)*/
        /*console.log("RESPONSE",res)
        console.log("AWAIT RESPONSE 2",await res.clone().text());
        console.log("AWAIT RESPONSE 3",await res.clone().json());*/
        try {
          return { ok: res.ok, data: await res.clone().json(), status:res.status };
        } catch (e) {
          console.log("La respuesta no es un JSON")
          /*console.log("RES", await res.clone())*/
          return { ok: false, data: await res.clone().text(), status:res.status };
        }

    })
    .catch(function(error) {
      console.log('Hubo un problema con la petición Fetch:' + error.message);
      throw error.message;
    });

  }

  static async requestArray(method,url){

    let data = [];

    try {

      const nocache = '?nocache=' + new Date().getTime();
      const request = await Connection.reqFetch(url + nocache, method);

      if (typeof request == 'undefined') return [];
      if (request.status != 200) { return [{label:'El error es',value:'-',name:'el error es'},{label:request.status, value:request.status, name:request.status}] }
      if (request.status != 200) return [];

      data = request.data;

      return data;

    } catch (e) {

      alert(e)
      return [];

    }

  }

  static async request(method, url, formData = null, headers = {}){
    //console.log('datos',formData)
    headers = {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest',
        ...headers,
        ...headerAuth
    }

    try {
      const nocache = '?nocache=' + new Date().getTime();
      const response = await Connection.reqFetch( url , method , formData, headers );/* qs.stringify(formData)*/

      //console.log("____response",response)

      if (response.ok)
        return { success: true, data: response.data };

      return { success: false, data: Connection.errorMessage(response) };

    } catch (e) {
      console.log('CATCH')
      return { success: false, data: Connection.errorMessage({ data: e, status: 600 }) };
      /*return { success: false, data: Connection.errorMessage(e.response) };*/

    }

    return false;

  }

  static async requestFD(method, url, formData = null, headers = {}){
    //console.log('datos',formData)
    headers = {
        /*'Content-Type': 'multipart/form-data',*/
        'X-Requested-With': 'XMLHttpRequest',
        ...headers,
        ...headerAuth
    }

    try {
      const nocache = '?nocache=' + new Date().getTime();
      const response = await Connection.reqFormData( url , method , formData, headers );/* qs.stringify(formData)*/

      //console.log("____response",response)

      if (response.ok)
        return { success: true, data: response.data };

      return { success: false, data: Connection.errorMessage(response) };

    } catch (e) {
      console.log('CATCH')
      return { success: false, data: Connection.errorMessage({ data: e, status: 600 }) };
      /*return { success: false, data: Connection.errorMessage(e.response) };*/

    }

    return false;

  }

}
