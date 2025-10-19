const path      =   require( "path" );

module.exports  =   {
 
    mode    :   "development",
    entry   :   { 
        
        controls    :   "./assets/src/js/controls.js",
        preview     :   "./assets/src/js/preview.js"
    }
    ,
    
    output  :   {

        path        :   path.resolve( __dirname, "assets/dist/js" ),
        filename    :   "[name].js"

    },

    module  : {

        rules   :   [{

            test    :   /\.js$/,
            exclude :   /node_modules/,
            use     :   {

                loader  :   'babel-loader',

                options :   {

                    presets :   [ "@babel/preset-env" ]

                }

            }

        }]

    }

};