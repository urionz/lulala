import React, {PropTypes} from 'react';
import {Form, Button, Row, Col, Icon, Popconfirm} from 'antd';
import SearchGroup from '../ui/search';


const ButtonGroup = Button.Group;

const search = ({
    field,
    selectedRows,
    keyword,
    onSearch,
    onAdd,
    handleDeletes,
    form: {
        getFieldDecorator,
        validateFields,
        getFieldsValue
    }
}) => {
    const searchGroupProps = {
        field,
        keyword,
        size: 'large',
        select: true,
        selectOptions: [{value: 'name', name: '姓名'}, {value: 'address', name: '地址'}],
        selectProps: {
            defaultValue: field || 'name'
        },
        onSearch: (value) => {
            onSearch(value)
        }
    };

    const hasSelected = selectedRows.length > 0;

    return (
        <Row gutter={24}>
            <Col lg={8} md={12} sm={16} xs={24} style={{marginBottom: 16}}>
                <SearchGroup {...searchGroupProps} />
            </Col>
            <Col lg={{offset: 8, span: 8}} md={12} sm={8} xs={24} style={{marginBottom: 16, textAlign: 'right'}}>
                <ButtonGroup>
                    <Button type="primary" onClick={onAdd}>
                        <Icon type="plus-circle-o"/> 新增
                    </Button>
                    <Popconfirm title='确定要删除吗？' onConfirm={handleDeletes}>
                        <Button type="primary" disabled={!hasSelected}>
                            <Icon type="delete"/> 删除
                        </Button>
                    </Popconfirm>
                </ButtonGroup>
            </Col>
        </Row>
    )
};

search.propTypes = {
    form: PropTypes.object.isRequired,
    onSearch: PropTypes.func,
    onAdd: PropTypes.func,
    field: PropTypes.string,
    keyword: PropTypes.string
};

export default Form.create()(search)
