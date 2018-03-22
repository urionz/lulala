// import Ajax from 'robe-ajax';
// import { apiUrl, apiPrefix } from './config';
// import qs from 'qs';
// import cookie from 'js-cookie';
// import { warning } from './index';
//
// const apiBase = apiUrl + apiPrefix;
//
// export default function request(url, options) {
//     if (options.cross) {
//         return Ajax.getJSON('http://query.yahooapis.com/v1/public/yql', {
//             q: "select * from json where url='" + url + '?' + Ajax.param(options.data) + "'",
//             format: 'json'
//         })
//     } else {
//         return Ajax.ajax({
//             url: apiBase + url,
//             method: options.method || 'get',
//             data: qs.stringify(options.data) || qs.stringify({}),
//             processData: options.method === 'get',
//             dataType: 'json',
//             headers:{
//                 'Accept': 'application/json',
//                 'Content-Type': 'application/x-www-form-urlencoded',
//                 'Authorization': 'Bearer ' + (cookie.get('access_token') ? cookie.get('access_token') : '')
//             },
//             error:function (response) {
//                 warning(response);
//             }
//         }).done((data) => {
//             return data
//         });
//     }
// }
import fetch from 'dva/fetch';
import { apiUrl, apiPrefix } from './config';
import qs from 'qs';
import cookie from 'js-cookie';
import { warning } from './index';

const apiBase = apiUrl + apiPrefix;

function check401(res) {
    // 登陆界面不需要做401校验
    if (res.status === 401 && !res.url.match('auth')) {
        // Modal.error({
        //     title: "登陆验证过期",
        //     content: "您的登陆验证已过期，请重新登陆",
        //     onOk: () => {
        //         cookie.remove('access_token');
        //         location.href = '/';
        //     }
        // });
        //
        // return Promise.reject(errorMessages(res));

    }
    return res;
}

function check404(res) {
    // if (res.status === 404) {
    //     return Promise.reject(errorMessages(res));
    // }
    return res;
}

function checkStatus(response) {
    // if (response.status >= 200 && response.status < 300) {
    //     return response;
    // } else {
    //     // 这里补充更多错误参数
    //     return response.text().then(errorMsg => {
    //         return new StandardError({
    //             statusCode: response.status,
    //             msg: errorMsg
    //         });
    //     }).then(err => { throw err; });
    // }
}

function setUriParam(keys, value, keyPostfix) {
    let keyStr = keys[0];

    keys.slice(1).forEach((key) => {
        keyStr += `[${key}]`;
    });

    if (keyPostfix) {
        keyStr += keyPostfix;
    }

    return `${encodeURIComponent(keyStr)}=${encodeURIComponent(value)}`;
}

function getUriParam(keys, object) {
    const array = [];

    if (object instanceof(Array)) {
        object.forEach((value) => {
            array.push(setUriParam(keys, value, '[]'));
        });
    } else if (object instanceof(Object)) {
        for (const key in object) {
            if (object.hasOwnProperty(key)) {
                const value = object[key];

                array.push(getUriParam(keys.concat(key), value));
            }
        }
    } else {
        if (object !== undefined) {
            array.push(setUriParam(keys, object));
        }
    }

    return array.join('&');
}

function toQueryString(object) {
    const array = [];

    for (const key in object) {
        if (object.hasOwnProperty(key)) {
            const str = getUriParam([key], object[key]);

            if (str !== '') {
                array.push(str);
            }
        }
    }

    return array.join('&');
}

function jsonParse(res) {
    return res.json();
}

export default async function request(url, options) {
    // const response = await fetch(url, options);
    if(options.cross){
        let opts = Object.assign({}, {}, options);

        opts.data.q = "select * from json where url='" + url + '?' + toQueryString(options.data) + "'";
        opts.data.format = 'json';

        opts.body = toQueryString(opts.data);
        return fetch('http://query.yahooapis.com/v1/public/yql?' + opts.body, {
            method:'get'
        }).then(jsonParse);
    }else{
        // return Ajax.ajax({
//             url: apiBase + url,
//             method: options.method || 'get',
//             data: qs.stringify(options.data) || qs.stringify({}),
//             processData: options.method === 'get',
//             dataType: 'json',
//             headers:{
//                 'Accept': 'application/json',
//                 'Content-Type': 'application/x-www-form-urlencoded',
//                 'Authorization': 'Bearer ' + (cookie.get('access_token') ? cookie.get('access_token') : '')
//             },
//             error:function (response) {
//                 warning(response);
//             }
//         }).done((data) => {
//             return data
//         });

        let mergeUrl = apiBase + url;

        const defaultPostHeader = {
            headers: {
                'Authorization': 'Bearer ' + (cookie.get('access_token') ? cookie.get('access_token') : ''),
                "Content-Type": "application/x-www-form-urlencoded"
            }
        };

        let opts = Object.assign({}, {}, options);

        if (opts && opts.method == "get" && opts.data) {
            mergeUrl = mergeUrl + '?' + toQueryString(opts.data);
        }else{
            opts.body = toQueryString(opts.data);
        }

        if(opts && opts.method != "get"){
            opts = Object.assign({}, defaultPostHeader, opts);
        }

        const defaultOptions = {
            method: 'get',
            headers: {
                'Authorization': 'Bearer ' + (cookie.get('access_token') ? cookie.get('access_token') : '')
            }
        };

        opts = Object.assign({}, defaultOptions, opts);

        return fetch(mergeUrl, {...opts}).then(jsonParse).catch(e => {
            return e;
        });
    }
}