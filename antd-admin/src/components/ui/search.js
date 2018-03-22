import React from 'react';
import ReactDOM from 'react-dom';
import styles from './search.less';
import {Input, Select, Button, Icon, DatePicker} from 'antd';

class Search extends React.Component {
    state = {
        clearVisible: false,
        selectValue: (this.props.select && this.props.selectProps) ? this.props.selectProps.defaultValue : '',
        dataVisible: false
    };
    handleSearch = () => {
        const data = {
            keyword: ReactDOM.findDOMNode(this.refs.searchInput).value
        };
        if (this.props.select) {
            data.field = this.state.selectValue
        }
        this.props.onSearch && this.props.onSearch(data)
    };
    handleInputChange = e => {
        this.setState({
            ...this.state,
            clearVisible: e.target.value !== ''
        });
    };
    handeleSelectChange = value => {
        let dataVisible = false;
        if(value == 'expire_at') dataVisible = true;
        this.setState({
            ...this.state,
            selectValue: value,
            dataVisible: dataVisible
        });
    };
    handleClearInput = () => {
        ReactDOM.findDOMNode(this.refs.searchInput).value = '';
        this.setState({
            clearVisible: false
        });
        this.handleSearch()
    };

    handleDataChange = (date, dateString) => {
        const data = {
            keyword: dateString
        };
        if (this.props.select) {
            data.field = this.state.selectValue;
        }
        this.props.onSearch && this.props.onSearch(data);
    };

    render() {
        const {size, select, selectOptions, selectProps, style, keyword} = this.props;
        const {clearVisible} = this.state;
        const { dataVisible } = this.state;
        return (
            <Input.Group compact size={size} className={styles.search} style={style}>
                {select && <Select ref='searchSelect' onChange={this.handeleSelectChange} size={size} {...selectProps}>
                    {selectOptions && selectOptions.map((item, key) => <Select.Option value={item.value}
                                                                                      key={key}>{item.name || item.value}</Select.Option>)}
                </Select>}
                { dataVisible ? <DatePicker onChange={this.handleDataChange} /> : <Input ref='searchInput' size={size} onChange={this.handleInputChange} onPressEnter={this.handleSearch}
                                                        defaultValue={keyword}/> }
                { !dataVisible && <Button size={size} type='primary' onClick={this.handleSearch}>搜索</Button> }
                {clearVisible && <Icon type='cross' onClick={this.handleClearInput}/>}
            </Input.Group>
        )
    }
}

export default Search
