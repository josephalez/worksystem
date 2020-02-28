export function getUri (state) {
  return route => {
    return state.app.apiUrl + '/' + route;
  }
}

/*export function organizations (state) {
  return state.organizations;
}*/
