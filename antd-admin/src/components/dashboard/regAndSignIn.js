import React from 'react'
import styles from './regAndSignIn.less'
import {color} from '../../utils'
import {AreaChart, Area, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer} from 'recharts'

function RegAndSignIn(props) {
    return (
        <div className={styles.sales}>
            <div className={styles.title}>注册趋势</div>
            <ResponsiveContainer minHeight={360}>
                <AreaChart data={props.data}>
                    <Legend verticalAlign='top'
                            content={props => {
                                const {payload} = props;
                                return <ul className={styles.legend + ' clearfix'}>
                                    {payload.map((item, key) => <li key={key}><span className={styles.radiusdot}
                                                                                    style={{background: item.color}}/>{item.value}
                                    </li>) }
                                </ul>
                            }}/>
                    <defs>
                        <linearGradient id="signin" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="5%" stopColor="#8884d8" stopOpacity={0.8}/>
                            <stop offset="95%" stopColor="#8884d8" stopOpacity={0}/>
                        </linearGradient>
                        <linearGradient id="register" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="5%" stopColor="#82ca9d" stopOpacity={0.8}/>
                            <stop offset="95%" stopColor="#82ca9d" stopOpacity={0}/>
                        </linearGradient>
                    </defs>
                    <XAxis dataKey='days'/>
                    <YAxis />
                    <CartesianGrid stroke={color.borderBase} strokeDasharray='3 3'/>
                    <Tooltip
                        wrapperStyle={{border: 'none', boxShadow: '4px 4px 40px rgba(0, 0, 0, 0.05)'}}
                        content={content => {
                            const list = content.payload.map((item, key) => <li key={key} className={styles.tipitem}>
                                <span className={styles.radiusdot}
                                      style={{background: item.color}}/>{item.name + ':' + item.value}</li>)
                            return <div className={styles.tooltip}><p className={styles.tiptitle}>{content.label}</p>
                                <ul>{list}</ul>
                            </div>
                        }}/>
                    <Area type='monotone' dataKey='count' name="注册数量" stroke="#8884d8" fillOpacity={1}
                          dot={{fill: color.purple}} activeDot={{r: 5, strokeWidth: 0}} fill="url(#signin)"/>
                </AreaChart>
            </ResponsiveContainer>
        </div>
    )
}

export default RegAndSignIn
