module.exports = {
    runtimeCompiler: true,
    publicPath: '/',
    lintOnSave: false,
    transpileDependencies: [
      'vue-echarts',
      'resize-detector'
    ],
    chainWebpack: config => {
      config.optimization.delete('splitChunks')
    },
    pages: {
      admin: {
        entry: 'src/main.js',
        template: 'public/index.html',
        filename: 'index.html'
      },
    },
  }

