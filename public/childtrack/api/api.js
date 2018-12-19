import fetch from './fetch'
const API_DOMAIN = 'https://dplay.darioshi.cn/api/'
/*
 * @param  {String} api 接口地址
 * @param  {Objece} params 接口参数参数
 */
function fetchApi (api, params) {
  return fetch(API_DOMAIN, api, params)
}

//首页
function Childtrack_getRecommend (params) {
  return fetchApi('Childtrack/getRecommend', params).then(res => res)
}

module.exports = {
  Childtrack_getRecommend,
}
