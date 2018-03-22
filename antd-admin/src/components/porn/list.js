import React, {PropTypes} from 'react'
import {Table, Popconfirm, Popover, Button} from 'antd';
import styles from './list.less';

const content = function (item) {
    return (
        <div>
            <p>ID ：{item.id}</p>
            <p>邮箱：{item.email}</p>
        </div>
    );
};

function list({
    loading,
    dataSource,
    pagination,
    onPageChange,
    onDeleteItem,
    onEditItem
}) {
    const columns = [
        {
            title: 'ID',
            dataIndex: 'id',
            key: 'id'
        }, {
            title: '卡号',
            dataIndex: 'code',
            key: 'code'
        }, {
            title: '所属用户',
            key: 'belong',
            render: (text, record) => (
                record.user_id ?
                    <p>
                        <Popover content={content(record.user_id)} title="用户信息" trigger="hover">
                            <a type="primary">{ record.user_id.email }</a>
                        </Popover>
                    </p> :
                    <p>无</p>
            )
        }, {
            title: '使用者',
            key: 'use',
            render: (text, record) => (
                record.use_id ?
                    <p>
                        <Popover content={content(record.use_id)} title="用户信息" trigger="hover">
                            <a type="primary">{ record.use_id.email }</a>
                        </Popover>
                    </p> :
                    <p>无</p>
            )
        }, {
            title: '过期时间',
            dataIndex: 'expire_at',
            key: 'expire_at'
        }, {
            title: '操作',
            key: 'operation',
            width: 100,
            render: (text, record) => (
                <p>
                    <Popconfirm title='确定要删除吗？' onConfirm={() => onDeleteItem(record.id)}>
                        <a>删除</a>
                    </Popconfirm>
                </p>
            )
        }
    ];

    return (
        <div>
            <Table
                className={styles.table}
                bordered
                scroll={{x: 1200}}
                columns={columns}
                dataSource={dataSource}
                loading={loading}
                onChange={onPageChange}
                pagination={pagination}
                simple
                rowKey={record => record.id}
            />
        </div>
    )
}

list.propTypes = {
    onPageChange: PropTypes.func,
    onDeleteItem: PropTypes.func,
    onEditItem: PropTypes.func,
    dataSource: PropTypes.array,
    loading: PropTypes.any,
    pagination: PropTypes.any
}

export default list
