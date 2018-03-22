import React, {PropTypes} from 'react';
import {Table, Popconfirm} from 'antd';
import styles from './list.less';

function list({
    loading,
    dataSource,
    pagination,
    onPageChange,
    onDeleteItem,
    onEditItem,
    handleSelectChange
}) {
    const rowSelection = {
        onChange: handleSelectChange
    };
    const columns = [
        {
            title: '头像',
            dataIndex: 'avatar',
            key: 'avatar',
            width: 64,
            className: styles.avatar,
            render: (text) => <img width={24} src={text ? text : '/assets/images/default_avatar.jpg'}/>
        }, {
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
            sorter: true,
        }, {
            title: '邮箱',
            dataIndex: 'email',
            key: 'email'
        }, {
            title: '创建时间',
            dataIndex: 'created_at',
            key: 'created_at',
            sorter: true,
        }, {
            title: '更新时间',
            dataIndex: 'updated_at',
            key: 'updated_at',
            sorter: true,
        }, {
            title: '操作',
            key: 'operation',
            width: 100,
            render: (text, record) => (
                <p>
                    <a onClick={() => onEditItem(record)} style={{
                        marginRight: 4
                    }}>编辑</a>
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
                rowSelection={rowSelection}
                rowKey={record => record.id}
            />
        </div>
    );
}

list.propTypes = {
    onPageChange: PropTypes.func,
    onDeleteItem: PropTypes.func,
    onEditItem: PropTypes.func,
    dataSource: PropTypes.array,
    loading: PropTypes.any,
    pagination: PropTypes.any
};

export default list;
