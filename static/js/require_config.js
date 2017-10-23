require.config({
  baseUrl: '/static',
  enforceDefine: false,
  paths: {
    jquery: './bower_components/jquery/dist/jquery.min',
    bootstrap: './bower_components/bootstrap/dist/js/bootstrap.min',

    globals: 'empty:'
  },

  shim: {
    jqplot: ['jquery'],
    bootstrap: {
      deps: ['jquery']
    }
  }
});
