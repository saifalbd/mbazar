const path = require("path");
// npm run serve -- --port 3000
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
    proxy: "http://127.0.0.1:8000/api",
    port: 3030,
  },
  css: {
    loaderOptions: {
      postcss: {
        path: "./postcss.config.js",
      },
    },
  },
 
};
