module.exports = {
    name: 'Lulala Admin',
    prefix: 'Lulala',
    footerText: 'Lulala Admin 版权所有 © 2016 由 urion 支持',
    logoSrc: 'https://t.alipayobjects.com/images/rmsweb/T1B9hfXcdvXXXXXXXX.svg',
    logoText: 'Lulala Admin',
    needLogin: true,
    apiUrl: process.env.NODE_ENV == 'production' ? 'http://lulala.com' : 'http://lulala.dev',
    apiPrefix: '/admin/api'
};
