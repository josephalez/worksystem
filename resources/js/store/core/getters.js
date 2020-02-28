export function getUri (state) {
  return route => {
    return state.app.apiUrl + '/' + route;
  }
}

export function organizations (state) {
  return state.organizations;
}
export function organization (state) {
  return state.organization;
}
export function assistances (state) {
  return state.assistances;
}
export function currentuser (state) {
  return state.currentuser;
}
