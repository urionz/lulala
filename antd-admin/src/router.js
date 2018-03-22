import React from 'react';
import {Router} from 'dva/router';
import App from './routes/app';

export default function ({history, app}) {
    const routes = [
        {
            path: '/',
            component: App,
            getIndexRoute (nextState, cb) {
                require.ensure([], require => {
                    cb(null, {component: require('./routes/dashboard')});
                });
            },
            childRoutes: [
                {
                    path: '/dashboard',
                    name: 'dashboard',
                    getComponent (nextState, cb) {
                        require.ensure([], require => {
                            cb(null, require('./routes/dashboard'));
                        });
                    }
                },
                // {
                //     path: '/setting',
                //     name: 'setting',
                //     getComponent (nextState, cb) {
                //         require.ensure([], require => {
                //             cb(null, require('./routes/setting'));
                //         });
                //     }
                // },
                {
                    path: '/users',
                    name: 'users',
                    getComponent (nextState, cb) {
                        require.ensure([], require => {
                            cb(null, require('./routes/users'))
                        })
                    }
                },
                {
                    path: '/cards/porn',
                    name: 'porn',
                    getComponent(nextState, cb) {
                        require.ensure([], require => {
                            cb(null, require('./routes/porn'));
                        });
                    }
                },
                // {
                //     path: 'ui/ico',
                //     name: 'ui/ico',
                //     getComponent (nextState, cb) {
                //         require.ensure([], require => {
                //             cb(null, require('./routes/ui/ico'))
                //         })
                //     }
                // }, {
                //     path: 'ui/search',
                //     name: 'ui/search',
                //     getComponent (nextState, cb) {
                //         require.ensure([], require => {
                //             cb(null, require('./routes/ui/search'))
                //         })
                //     }
                // },
                {
                    path: '*',
                    name: 'error',
                    getComponent (nextState, cb) {
                        require.ensure([], require => {
                            cb(null, require('./routes/error'));
                        });
                    }
                }
            ]
        }
    ];

    return <Router history={history} routes={routes}/>;
}
