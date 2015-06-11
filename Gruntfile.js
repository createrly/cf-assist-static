module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concat: {
      options: {
        separator: ';'
      },
      dist: {
        src: [
          'static/assets/plugins/jquery/jquery.min.js',
          'static/assets/plugins/jquery/jquery-migrate.min.js',
          'static/assets/plugins/bootstrap/js/bootstrap.min.js',
          'static/assets/plugins/back-to-top.js',
          'static/assets/plugins/smoothScroll.js',
          'static/assets/plugins/parallax-slider/js/modernizr.js',
          'static/assets/plugins/parallax-slider/js/jquery.cslider.js',
          'static/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js',
          'static/assets/js/custom.js',
          'static/assets/js/app.js',
          'static/assets/js/plugins/owl-carousel.js',
          'static/assets/js/plugins/parallax-slider.js'
        ],
        dest: 'dist/<%= pkg.name %>.js'
      }
    },
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          'dist/<%= pkg.name %>.min.js': ['<%= concat.dist.dest %>']
        }
      }
    },
    jshint: {
      files: [
        'static/assets/plugins/jquery/jquery.min.js',
        'static/assets/plugins/jquery/jquery-migrate.min.js',
        'static/assets/plugins/bootstrap/js/bootstrap.min.js',
        'static/assets/plugins/back-to-top.js',
        'static/assets/plugins/smoothScroll.js',
        'static/assets/plugins/parallax-slider/js/modernizr.js',
        'static/assets/plugins/parallax-slider/js/jquery.cslider.js',
        'static/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js',
        'static/assets/js/custom.js',
        'static/assets/js/app.js',
        'static/assets/js/plugins/owl-carousel.js',
        'static/assets/js/plugins/parallax-slider.js'
      ],
      options: {
        // options here to override JSHint defaults
        globals: {
          jQuery: true,
          console: false,
          module: true,
          document: true
        }
      }
    },
    watch: {
      files: ['<%= jshint.files %>'],
      tasks: ['concat']
    },
    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1,
        sourceMap: true,
        report: 'min'
      },
      target: {
        files: {
          'dist/style.css': [
            'static/assets/plugins/bootstrap/css/bootstrap.min.css',
            'static/assets/css/style.css',
            'static/assets/css/headers/header-default.css',
            'static/assets/css/footers/footer-v1.css',
            'static/assets/plugins/animate.css',
            'static/assets/plugins/line-icons/line-icons.css',
            'static/assets/plugins/font-awesome/css/font-awesome.min.css',
            'static/assets/plugins/parallax-slider/css/parallax-slider.css',
            'static/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css',
            'static/assets/css/blocks.css',
            'static/assets/css/custom.css'
          ]
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-qunit');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  grunt.registerTask('test', ['jshint']);

  grunt.registerTask('default', ['concat', 'uglify', 'cssmin']);
};
