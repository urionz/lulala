import React, {PropTypes} from 'react'
import {Form, Button, Row, Col} from 'antd'
import SearchGroup from '../ui/search'

const search = ({
    field,
    keyword,
    onSearch,
    onAdd,
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
        selectOptions: [{value: 'code', name: '卡号'}, {value: 'belong', name: '所属用户'}, {value: 'use_id', name: '使用者'}, {value: 'expire_at', name: '过期时间'}],
        selectProps: {
            defaultValue: field || 'code'
        },
        onSearch: (value) => {
            onSearch(value)
        }
    };

    return (
        <Row gutter={24}>
            <Col lg={8} md={12} sm={16} xs={24} style={{marginBottom: 16}}>
                <SearchGroup {...searchGroupProps} />
            </Col>
            <Col lg={{offset: 8, span: 8}} md={12} sm={8} xs={24} style={{marginBottom: 16, textAlign: 'right'}}>
                <Button size='large' type='ghost' onClick={onAdd}>添加</Button>
            </Col>
        </Row>
    );
};

search.propTypes = {
    form: PropTypes.object.isRequired,
    onSearch: PropTypes.func,
    onAdd: PropTypes.func,
    field: PropTypes.string,
    keyword: PropTypes.string
};

export default Form.create()(search)
