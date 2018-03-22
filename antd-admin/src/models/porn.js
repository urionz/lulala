import {create, remove, update, query} from '../services/porn'
import {parse} from 'qs'

export default {

    namespace: 'porn',

    state: {
        list: [],
        loading: false,
        currentItem: {},
        modalVisible: false,
        modalType: 'create',
        pagination: {
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: total => `共 ${total} 条`,
            current: 1,
            total: null
        }
    },

    subscriptions: {
        setup ({dispatch, history}) {
            history.listen(location => {
                if (location.pathname === '/cards/porn') {
                    dispatch({
                        type: 'query',
                        payload: location.query
                    })
                }
            })
        }
    },

    effects: {
        *query ({payload}, {call, put}) {
            yield put({type: 'showLoading'})
            const data = yield call(query, parse(payload))
            if (data) {
                yield put({
                    type: 'querySuccess',
                    payload: {
                        list: data.data.data,
                        pagination: {
                            total: data.data.total,
                            current: data.data.current_page,
                        }
                    }
                })
            }
        },
        *'delete' ({payload}, {call, put}) {
            yield put({type: 'showLoading'})
            const data = yield call(remove, {id: payload})
            if (data && data.status_code == 200) {
                yield put({
                    type: 'querySuccess',
                    payload: {
                        list: data.data.data,
                        pagination: {
                            total: data.data.total,
                            current: data.data.current_page,
                        }
                    }
                })
            }
        },
        *create ({payload}, {call, put}) {
            yield put({type: 'hideModal'})
            yield put({type: 'showLoading'})
            const data = yield call(create, payload)
            if (data && data.status_code == 200) {
                yield put({
                    type: 'querySuccess',
                    payload: {
                        list: data.data.data,
                        pagination: {
                            total: data.data.total,
                            current: data.data.current_page,
                        }
                    }
                })
            }
        }
    },

    reducers: {
        showLoading (state) {
            return {...state, loading: true}
        },
        querySuccess (state, action) {
            const {list, pagination} = action.payload
            return {
                ...state,
                list,
                loading: false,
                pagination: {
                    ...state.pagination,
                    ...pagination
                }
            }
        },
        showModal (state, action) {
            return {...state, ...action.payload, modalVisible: true}
        },
        hideModal (state) {
            return {...state, modalVisible: false}
        }
    }

}
