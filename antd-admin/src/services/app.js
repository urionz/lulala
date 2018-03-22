import {request} from '../utils'

export async function login(params) {
    console.log(params);
    return request('/login', {
        method: 'post',
        data: params
    })
}

export async function logout(params) {
    return request('/auth/logout', {
        method: 'get',
        data: params
    })
}

export async function userInfo(params) {
    return request('/auth/get', {
        method: 'get',
        data: params
    })
}
