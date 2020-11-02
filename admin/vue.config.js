const path = require("path");
module.exports = {
  lintOnSave: false,
  configureWebpack: {
   
    resolve: {
      alias: {
        "~@storefront-ui/shared": path.resolve(__dirname, './src/assets/shared'),
        "~@storefront-ui/vue": path.resolve(__dirname, '.'),
        "@storefront-ui/vue": path.resolve(__dirname, './index.js')
      }
    }
  },
  devServer: {
    proxy: "http://127.0.0.1:8000/admin/api"
  },
  css: {
    loaderOptions: {
      postcss: {
        path: "./postcss.config.js",
      },
    },
  },
 
};
