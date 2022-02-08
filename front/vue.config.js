module.exports = {
  pluginOptions: {
    quasar: {
      importStrategy: "kebab",
      rtlSupport: false,
    },
  },
  transpileDependencies: ["quasar"],
  devServer: {
    // API connection
    // proxy: "http://localhost:5000", 
    port: 8888
  },
  // publicPath: "./public",
};
