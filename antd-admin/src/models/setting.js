import {create, remove, update, query} from '../services/setting';
import {parse} from 'qs';
import { warning } from '../utils';

export default {

    namespace: 'setting',

    state: {
        list: [],
        loading: false
    },

    subscriptions: {
        setup ({dispatch, history}) {
            history.listen(location => {
                if (location.pathname === '/setting') {
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

                    }
                })
            }else{
                warning(data.error);
            }
        },
        *update ({payload}, {select, call, put}) {
            yield put({type: 'hideModal'});
            yield put({type: 'showLoading'});
            const id = yield select(({users}) => users.currentItem.id);
            const newUser = {...payload, id};
            const data = yield call(update, newUser);
            if (data && data.success) {
                yield put({
                    type: 'querySuccess',
                    payload: {

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
        }
    }

}
