module.exports = {
  pluginOptions: {
    quasar: {
      importStrategy: "kebab",
      rtlSupport: false,
    },
    cordovaPath: "src-cordova",
  },

  transpileDependencies: ["quasar"],

  // devServer: {
  //   proxy: "http://localhost:5000",
  // },

  publicPath: "",
};
