'use strict';

const { src, dest, watch } = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const sourcemaps = require('gulp-sourcemaps')
const browserSync = require('browser-sync')
const uglify = require('gulp-uglify')
const minifyCss = require('gulp-clean-css')
const rename = require("gulp-rename")

const pathAssets = './assets'
const pathNodeModule = './node_modules'

// server
function server() {
    browserSync.init({
        proxy: "localhost/suckhoecantho",
        open: false,
        cors: true,
        ghostMode: false,
        notify: false,
        injectChanges: true
    })
}

/*
Task build Bootstrap
* */

// Task build style bootstrap
function buildStylesBootstrap() {
    return src(`${pathAssets}/scss/bootstrap.scss`)
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathAssets}/libs/bootstrap/`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// Task build js bootstrap
function buildLibsBootstrapJS() {
    return src([
        `${pathNodeModule}/bootstrap/dist/js/bootstrap.bundle.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/bootstrap/`))
        .pipe(browserSync.stream());
}

exports.buildLibsBootstrapJS = buildLibsBootstrapJS

/*
Task build owl carousel
* */
function buildStylesOwlCarousel() {
    return src(`${pathNodeModule}/owl.carousel/dist/assets/owl.carousel.css`)
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/owl.carousel/`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

function buildJsOwlCarouse() {
    return src([
        `${pathNodeModule}/owl.carousel/dist/owl.carousel.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest(`${pathAssets}/libs/owl.carousel/`))
        .pipe(browserSync.stream());
}

// Task build style
function buildStylesTheme() {
    return src(`${pathAssets}/scss/style-theme.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// Task build style elementor
function buildStylesElementor() {
    return src(`${pathAssets}/scss/elementor-addon/elementor-addon.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`./extension/elementor-addon/css/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`./extension/elementor-addon/css/`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

function buildJSElementor() {
    return src([
        './extension/elementor-addon/js/*.js',
        '!./extension/elementor-addon/js/*.min.js'
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(dest('./extension/elementor-addon/js/'))
        .pipe(browserSync.stream());
}

// Task build style templates
function buildStylesTemplates() {
    return src(`${pathAssets}/scss/templates/*.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/templates/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/templates/`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// Task build style custom post type
function buildStylesCustomPostType() {
    return src(`${pathAssets}/scss/post-type/*/**.scss`)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/post-type/`))
        .pipe(sourcemaps.init())
        .pipe(minifyCss({
            level: {1: {specialComments: 0}}
        }))
        .pipe(rename( {suffix: '.min'} ))
        .pipe(sourcemaps.write())
        .pipe(dest(`${pathAssets}/css/post-type/`))
        .pipe(browserSync.stream({ match: '**/*.css' }));
}

// buildJSTheme
function buildJSTheme() {
    return src([
        `${pathAssets}/js/*.js`,
        `!${pathAssets}/js/*.min.js`
    ], {allowEmpty: true})
        .pipe(uglify())
        .pipe(rename( {suffix: '.min'} ))
        .pipe(dest(`${pathAssets}/js/`))
        .pipe(browserSync.stream());
}

/*
Task build project
* */
async function buildProject() {
    await buildStylesBootstrap()
    await buildLibsBootstrapJS()

    await buildStylesOwlCarousel()
    await buildJsOwlCarouse()

    await buildStylesTheme()
    await buildJSTheme()

    await buildStylesTemplates()

    await buildStylesCustomPostType()

    await buildStylesElementor()
    await buildJSElementor()
}
exports.buildProject = buildProject


// Task watch
function watchTask() {
    server()

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/bootstrap.scss`
    ], buildStylesBootstrap)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/base/*.scss`,
        `${pathAssets}/scss/style.scss`,
    ], buildStylesTheme)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/elementor-addon/*.scss`
    ], buildStylesElementor)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/templates/*.scss`
    ], buildStylesTemplates)

    watch([
        `${pathAssets}/scss/variables-site/*.scss`,
        `${pathAssets}/scss/post-type/*/**.scss`
    ], buildStylesCustomPostType)

    watch([`${pathAssets}/js/*.js`, `!${pathAssets}/js/*.min.js`], buildJSTheme)

    watch([
        './extension/elementor-addon/js/*.js',
        '!./extension/elementor-addon/js/*.min.js'
    ], buildJSElementor)

    watch([
        './*.php',
        './**/*.php',
        './assets/images/*/**.{png,jpg,jpeg,gif}'
    ], browserSync.reload);
}
exports.watchTask = watchTask