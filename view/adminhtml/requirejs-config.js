var config = {
    paths: {
        react: 'https://unpkg.com/react@18/umd/react.production.min',
        'react-dom': 'https://unpkg.com/react-dom@18/umd/react-dom.production.min',
        axios: 'https://unpkg.com/axios@1.11.0/dist/axios.min',
        'amadeco/opcache-gui': 'Amadeco_OpcacheGui/js/gui'
    },
    shim: {
        react: {
            exports: 'React'
        },
        'react-dom': {
            exports: 'ReactDOM'
        }
    }
};