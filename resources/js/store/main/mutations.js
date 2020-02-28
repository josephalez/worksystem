export function setData (state, params) {
  const key = params.key;
  const data = params.data;
  state[key] =  data;
}
