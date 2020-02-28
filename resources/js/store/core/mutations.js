export function setData (state, params) {
  const key = params.key;
  const data = params.data;
  console.log('key: ', key, 'data: ', data);
  state[key] =  data;
  console.log("FIRST", state);
}
