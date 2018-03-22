import React, {PropTypes} from 'react';
import {routerRedux} from 'dva/router';
import { connect } from 'dva';
import PornList from '../components/porn/list';
import PornSearch from '../components/porn/search';
import PornModal from '../components/porn/modal';

function Porn({location, dispatch, porn}) {
    const {loading, list, pagination, currentItem, modalVisible, modalType} = porn;
    const {field, keyword} = location.query;

    const pornModalProps = {
        item: {},
        type: modalType,
        visible: modalVisible,
        onOk (data) {
            dispatch({
                type: `porn/${modalType}`,
                payload: data
            })
        },
        onCancel () {
            dispatch({
                type: 'porn/hideModal'
            })
        }
    };

    const pornListProps = {
        dataSource: list,
        loading,
        pagination: pagination,
        onPageChange (page) {
            const query = location.query;
            dispatch(routerRedux.push({
                pathname: '/cards/porn',
                query: {
                    ...query,
                    page: page.current,
                    pageSize: page.pageSize
                }
            }));
        },
        onDeleteItem (id) {
            dispatch({
                type: 'porn/delete',
                payload: id
            });
        },
        onEditItem (item) {
            dispatch({
                type: 'porn/showModal',
                payload: {
                    modalType: 'update',
                    currentItem: item
                }
            });
        }
    };

    const pornSearchProps = {
        field,
        keyword,
        onSearch (fieldsValue) {
            !!fieldsValue.keyword.length ?
                dispatch(routerRedux.push({
                    pathname: '/cards/porn',
                    query: {
                        field: fieldsValue.field,
                        keyword: fieldsValue.keyword
                    }
                })) :
                dispatch(routerRedux.push({
                    pathname: '/cards/porn'
                }));

            dispatch({
                type: 'porn/query',
                payload: fieldsValue
            })
        },
        onAdd () {
            dispatch({
                type: 'porn/showModal',
                payload: {
                    modalType: 'create'
                }
            })
        }
    };

    const PornModalGen = () =>
        <PornModal {...pornModalProps} />

    return (
        <div className='content-inner'>
            <PornSearch {...pornSearchProps} />
            <PornList {...pornListProps} />
            <PornModalGen />
        </div>
    )
}

Porn.propTypes = {
    Porn: PropTypes.object,
    location: PropTypes.object,
    dispatch: PropTypes.func
};

function mapStateToProps({porn}) {
    return {porn}
}

export default connect(mapStateToProps)(Porn)
