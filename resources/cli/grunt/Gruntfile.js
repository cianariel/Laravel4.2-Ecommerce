module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            main: {
                src: [
                    '../../assets/main/sass/app.scss',
                ],
                dest: '../../assets/main/css/app.css'
            },
        },
        concat: {
            options: {
                separator:  ';\n' ,
            },
            main: {
                src: [
                    '../../assets/js/app.js',
                    '../../assets/main/js/angular-custom/custom.paging.js',
                    '../../assets/main/js/angular-custom/custom.product.js',
                    '../../assets/main/js/angular-custom/public.common.js',
                ],
                dest: '../../../public/assets/js/main.js'
            },
            admin: {
                src: [
                    '../../assets/admin/js/custom.admin.js',
                    '../../assets/admin/js/vendor/angular-file-upload.min.js',
                    '../../assets/admin/js/vendor/bootstrap.min.js',
                    '../../assets/admin/js/vendor/jquery.min.js',
                    '../../assets/admin/js/vendor/metisMenu.min.js',
                    '../../assets/admin/js/vendor/ng-rateit.min.js',
                    //'../../assets/admin/js/vendor/sb-admin-2.js', TODO -- unused?
                ],
                dest: '../../../public/assets/js/admin.js'
            },
            maincss: {
                src: [
                    '../../assets/main/css/*.css',
                ],
                dest: '../../../public/assets/css/main.css'
            },
            admincss: {
                src: [
                    '../../assets/admin/css/*.css',
                ],
                dest: '../../../public/assets/css/admin.css'
            },
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n',
                //preserveComments: 'all',
            },
            all: {
                files: {
                    '../../../public/assets/js/main.js': ['<%= concat.main.dest %>'],
                    '../../../public/assets/js/admin.js': ['<%= concat.admin.dest %>']
                }
            },
        },
        cssmin: {
            main: {
                options:{
                    keepSpecialComments:0
                },
                files: {
                    '../../../public/assets/css/main.css': ['<%= concat.maincss.dest %>'],
                    '../../../public/assets/css/admin.css': ['<%= concat.admincss.dest %>']

                }
            },
        },

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
            js: {
                files: ['<%= concat.main.src %>', '<%= concat.admin.src %>'],
                tasks: ['js']
            },
            css: {
                files: ['../../assets/main/css/*', '../../assets/admin/css/*', '../../assets/main/sass/*'],
                tasks: ['css']
            },
        },
        apidoc: {
            ideaing_api: {
                src: "../../application/modules/api/",
                dest: "../../doc/api/"
            }
        },
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    //grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-closure-tools');

    //grunt.registerTask('jshint', ['jshint']);
    grunt.registerTask('default', ['sass', 'concat', 'uglify', 'cssmin']);
    grunt.registerTask('js', ['concat:main', 'concat:admin', 'uglify:all']);
    grunt.registerTask('css', ['sass', 'concat:maincss','concat:admincss','cssmin']);


};