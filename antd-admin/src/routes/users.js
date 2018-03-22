import React, {PropTypes} from 'react';
import {routerRedux} from 'dva/router';
import {connect} from 'dva';
import UserList from '../components/users/list';
import UserSearch from '../components/users/search';
import UserModal from '../components/users/modal';

function Users({location, dispatch, users}) {
    const {loading, list, pagination, currentItem, modalVisible, modalType, selectedRows} = users;
    const {field, keyword} = location.query;

    const userModalProps = {
        item: modalType === 'create' ? {} : currentItem,
        type: modalType,
        visible: modalVisible,
        onOk (data) {
            dispatch({
                type: `users/${modalType}`,
                payload: data
            })
        },
        onCancel () {
            dispatch({
                type: 'users/hideModal'
            })
        }
    };

    const userListProps = {
        dataSource: list,
        loading,
        pagination: pagination,
        onPageChange (page, filters, sorter) {
            const query = location.query;
            dispatch(routerRedux.push({
                pathname: '/users',
                query: {
                    ...query,
                    page: page.current,
                    pageSize: page.pageSize,
                    sortField: sorter.field,
                    sortOrder: sorter.order ? sorter.order == 'ascend' ? 'asc' : 'desc' : sorter.order
                }
            }));
        },
        onDeleteItem (id) {
            dispatch({
                type: 'users/delete',
                payload: id
            })
        },
        onEditItem (item) {
            dispatch({
                type: 'users/showModal',
                payload: {
                    modalType: 'update',
                    currentItem: item
                }
            })
        },
        handleSelectChange(rows, selectedRows){
            dispatch({
                type: 'users/selectedRow',
                payload: {
                    selectedRows
                }
            });
        }
    };

    const userSearchProps = {
        field,
        selectedRows,
        keyword,
        onSearch (fieldsValue) {
            !!fieldsValue.keyword.length ?
                dispatch(routerRedux.push({
                    pathname: '/users',
                    query: {
                        field: fieldsValue.field,
                        keyword: fieldsValue.keyword
                    }
                })) :
                dispatch(routerRedux.push({
                    pathname: '/users'
                }));

            dispatch({
                type: 'users/query',
                payload: fieldsValue
            })
        },
        onAdd () {
            dispatch({
                type: 'users/showModal',
                payload: {
                    modalType: 'create'
                }
            })
        },
        handleDeletes() {
            let ids = [];
            selectedRows.forEach(function (item) {
                ids.push(item.id);
            });
            dispatch({
                type: 'users/delete',
                payload: `${ids.join(',')}`
            })
        }
    };

    const UserModalGen = () =>
        <UserModal {...userModalProps} />;

    return (
        <div className='content-inner'>
            <UserSearch {...userSearchProps} />
            <UserList {...userListProps} />
            <UserModalGen />
        </div>
    );
}

Users.propTypes = {
    users: PropTypes.object,
    location: PropTypes.object,
    dispatch: PropTypes.func
};

function mapStateToProps({users}) {
    return {users};
}

export default connect(mapStateToProps)(Users);
