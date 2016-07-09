module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);

    var filesystem  = require('fs');
    var glob = require('glob');

    var dist_dir = 'dist/';

    var apibsToIgnore = [];
    if (filesystem.existsSync('ignore-apibs.json')) {
        apibsToIgnore = grunt.file.readJSON('ignore-apibs.json');
    }
    var blueprints = {};
    blueprints.docs = glob.sync('@(!(*.dist).apib)');
    blueprints.payloads = glob.sync('payloads/**/*.json');

    // Ignore files specified in `ignore-apibs.json`
    blueprints.docs = blueprints.docs.filter(function (value) {
        return apibsToIgnore.indexOf(value) === -1;
    });

    blueprints.dists = blueprints.docs.map(function (value) {
        return dist_dir + value.replace('.apib', '') + '.dist.apib';
    });

    blueprints.asts = blueprints.docs.map(function (value) {
        return value + '.ast.json';
    });

    blueprints.html = blueprints.docs.map(function (value) {
        return dist_dir + value.split('.')[0] + '.html';
    });

    blueprints.html_to_dist = {};
    for (var index in blueprints.html) {
        blueprints.html_to_dist[blueprints.html[index]] = [blueprints.dists[index]];
    }

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        clean: blueprints.dists.concat(blueprints.asts.concat(blueprints.html)),

        hercule: function() {
            var hercule_config = {};
            for (var i in blueprints.docs) {
                hercule_config[i] = {
                    src : blueprints.docs[i],
                    dest: dist_dir + blueprints.docs[i].split('.')[0] + '.dist.apib'
                }
            }

            return hercule_config;
        }(),

        aglio: {
            dist: {
                files: blueprints.html_to_dist
            },
            options: {
                themeFullWidth: false
            }
        }
    });

    // Define grunt interface
    grunt.registerTask('default', function () {
        grunt.log.write('Use "grunt serve" for development and "grunt build" for distribution');
        grunt.log.write('Update the framework using "grunt update"');
    });
    grunt.registerTask('build', 'Run the build stack without live reload', ['clean', 'hercule', 'aglio']);
};
