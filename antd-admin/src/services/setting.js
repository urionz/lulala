import {request} from '../utils'

export async function query(params) {
    return request('/setting/get', {
        method: 'get',
        data: params
    })
}

export async function create(params) {
    return request('/setting/add', {
        method: 'post',
        data: params
    })
}

export async function remove(params) {
    return request('/setting/delete', {
        method: 'delete',
        data: params
    })
}

export async function update(params) {
    return request('/setting/update', {
        method: 'put',
        data: params
    })
}
