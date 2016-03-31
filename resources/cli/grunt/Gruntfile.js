module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                separator: ';'
            },
            general: {
                src: [
                    '../../assets/js/app.js',
                    //'../../public/media/js/binumi/packages/*.js'
                ],
                dest: '../../../public/assets/js/general.js'
            },
            //admin: {
            //    src: [
            //        '../../public/media/js/admin/packages/core.js',
            //        '../../public/media/js/binumi/packages/layout.js',
            //        '../../public/media/js/binumi/packages/ajax.js',
            //        '../../public/media/js/binumi/packages/language.js',
            //        '../../public/media/js/binumi/packages/uploader.js',
            //        '../../public/media/js/binumi/packages/utils.js',
            //        '../../public/media/js/admin/packages/*.js'
            //    ],
            //    dest: '../../public/media/js/admin/admin.js'
            //}
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
            },
            general: {
                files: {
                    '../../../public/assets/js/general.js': ['<%= concat.general.dest %>']
                }
            },
            //portal: {
            //    files: {
            //        '../../public/media/js/portal/portal.min.js': ['<%= concat.portal.dest %>']
            //    }
            //},
            //admin: {
            //    files: {
            //        '../../public/media/js/admin/admin.min.js': ['<%= concat.admin.dest %>']
            //    }
            //}
        },
        //cssmin: {
        //    binumi: {
        //        options:{
        //            keepSpecialComments:0
        //        },
        //        files: {
        //            "../../public/media/css/v3/binumi.min.css": ["../../public/media/css/v3/binumi.css"]
        //        }
        //    },
        //    portal:{
        //        options:{
        //            keepSpecialComments:0
        //        },
        //        files: {
        //            "../../public/media/css/portal/portal.min.css": ["../../public/media/css/portal/portal.css"]
        //        }
        //    },
        //    admin:{
        //        options:{
        //            keepSpecialComments:0
        //        },
        //        files: {
        //            "../../public/media/css/admin/admin.min.css": ["../../public/media/css/admin/admin.css"]
        //        }
        //    }
        //},
        //jshint: {
        //    files: ['gruntfile.js', '../../public/media/js/binumi/packages/*.js'],
        //    options: {
        //        // options here to override JSHint defaults
        //        globals: {
        //            jQuery: true,
        //            console: true,
        //            module: true,
        //            document: true
        //        }
        //    }
        //},
        watch: {
            /*test: {
                files: ['<%= jshint.files %>'],
                tasks: ['jshint', 'qunit']
            },*/
            js: {
                files: ['<%= concat.general.src %>'],
                tasks: ['js']
            },
            //css: {
            //    files: ['../../public/media/css/v3/less/*'],
            //    tasks: ['css']
            //},
            //jsAdmin: {
            //    files: ['<%= concat.admin.src %>'],
            //    tasks: ['jsAdmin']
            //},
            //cssAdmin: {
            //    files: ['../../public/media/css/admin/less/*'],
            //    tasks: ['cssAdmin']
            //}
        },
        apidoc: {
            ideaing_api: {
                src: "../../application/modules/api/",
                dest: "../../doc/api/"
            }
        },
        closureCompiler:  {

            options: {
                compilerFile: '../compiler.jar',
                checkModified: true,
                compilerOpts: {
                    compilation_level: 'SIMPLE_OPTIMIZATIONS',
                    externs: ['externs/*.js'],
                    //define: ["'goog.DEBUG=false'"],
                    warning_level: 'verbose',
                    jscomp_off: ['checkTypes', 'fileoverviewTags'],
                    summary_detail_level: 3,
                    output_wrapper: '"(function(){%output%}).call(this);"'
                },
                execOpts: {
                    maxBuffer: 999999 * 1024
                }
            },
            //binumi: {
            //    src: '../../public/media/js/binumi/binumi.js',
            //    dest: '../../public/media/js/binumi/binumi.compile.js'
            //},
            //portal: {
            //    src: '../../public/media/js/portal/portal.js',
            //    dest: '../../public/media/js/portal/portal.compile.js'
            //},
            //admin: {
            //    src: '../../public/media/js/admin/admin.js',
            //    dest: '../../public/media/js/admin/admin.compile.js'
            //}
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    //grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    //grunt.loadNpmTasks('grunt-contrib-less');
    //grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-closure-tools');
    //grunt.loadNpmTasks('grunt-apidoc');
    
    grunt.registerTask('test', ['jshint']);

    grunt.registerTask('default', ['concat', 'uglify']);

    grunt.registerTask('js', ['concat:general', 'uglify:general']);
    //grunt.registerTask('closure', ['closureCompiler:binumi']);
    //grunt.registerTask('css', ['less:binumi','cssmin:binumi']);

    //grunt.registerTask('jsPortal', ['concat:portal', 'uglify:portal']);
    //grunt.registerTask('closurePortal', ['closureCompiler:portal']);
    //grunt.registerTask('cssPortal', ['less:portal','cssmin:portal']);
    //
    //grunt.registerTask('jsAdmin', ['concat:admin', 'uglify:admin']);
    //grunt.registerTask('closureAdmin', ['closureCompiler:admin']);
    //grunt.registerTask('cssAdmin', ['less:admin','cssmin:admin']);
    //
    //grunt.registerTask('doc', ['apidoc']);

};