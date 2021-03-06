import {create, remove, update, query} from '../services/users';
import {parse} from 'qs';
import { warning } from '../utils';

export default {

    namespace: 'users',

    state: {
        list: [],
        loading: false,
        currentItem: {},
        selectedRows:[],
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
                if (location.pathname === '/users') {
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
            yield put({type: 'showLoading'});
            const data = yield call(query, parse(payload));
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
            }else{
                warning(data.error);
            }
        },
        *'delete' ({payload}, {call, put}) {
            yield put({type: 'showLoading'});
            const data = yield call(remove, {id: payload});
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
                });
            }
        },
        *create ({payload}, {call, put}) {
            yield put({type: 'hideModal'});
            yield put({type: 'showLoading'});
            const data = yield call(create, payload);
            if (data && data.success) {
                yield put({
                    type: 'querySuccess',
                    payload: {
                        list: data.data,
                        pagination: {
                            total: data.page.total,
                            current: data.page.current
                        }
                    }
                })
            }
        },
        *update ({payload}, {select, call, put}) {
            yield put({type: 'hideModal'})
            yield put({type: 'showLoading'})
            const id = yield select(({users}) => users.currentItem.id)
            const newUser = {...payload, id}
            const data = yield call(update, newUser)
            if (data && data.success) {
                yield put({
                    type: 'querySuccess',
                    payload: {
                        list: data.data,
                        pagination: {
                            total: data.page.total,
                            current: data.page.current
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
            const {list, pagination} = action.payload;
            return {
                ...state,
                list,
                selectedRows: [],
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
        },
        selectedRow(state, action) {
            const {selectedRows} = action.payload;
            return {...state, selectedRows};
        }
    }

}
