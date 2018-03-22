import React, {PropTypes} from 'react'
import {Form, Input, InputNumber, Radio, Modal, Select} from 'antd'
const FormItem = Form.Item;

const formItemLayout = {
    labelCol: {
        span: 6
    },
    wrapperCol: {
        span: 14
    }
};

const modal = ({
    visible,
    type,
    item = {},
    onOk,
    onCancel,
    form: {
        getFieldDecorator,
        validateFields,
        getFieldsValue
    }
}) => {
    function handleOk() {
        validateFields((errors) => {
            if (errors) {
                return
            };
            const data = {
                ...getFieldsValue(),
                key: item.key
            };
            onOk(data)
        })
    }

    const modalOpts = {
        title: '邀请码生成',
        visible,
        onOk: handleOk,
        onCancel,
        wrapClassName: 'vertical-center-modal'
    };

    return (
        <Modal {...modalOpts}>
            <Form horizontal>
                <FormItem label='绑定用户(ID)：' hasFeedback {...formItemLayout}>
                    {getFieldDecorator('user_id')(<InputNumber />)}
                </FormItem>
                <FormItem label='生成数量：' hasFeedback {...formItemLayout}>
                    {getFieldDecorator('count', {
                        initialValue:100,
                        rules: [
                            {
                                required: true,
                                type: 'number',
                                message: '未输入数量'
                            }
                        ]
                    })(<InputNumber min={1} max={200} />)}
                </FormItem>
            </Form>
        </Modal>
    )
};

modal.propTypes = {
    visible: PropTypes.any,
    form: PropTypes.object,
    item: PropTypes.object,
    onOk: PropTypes.func,
    onCancel: PropTypes.func
};

export default Form.create()(modal)
