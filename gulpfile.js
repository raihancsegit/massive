"use strict";

const gulp = require("gulp");
const browserSync = require("browser-sync");
const plumberNotifier = require("gulp-plumber-notifier");
const autoPrefixer = require("gulp-autoprefixer");
const sass = require("gulp-sass");
const concat = require("gulp-concat");
const csscomb = require("gulp-csscomb");
const rename = require("gulp-rename");
const cssmin = require("gulp-cssmin");

// Paths
var shortcodes = "assets/css/shortcodes/*.scss";
var partials = "assets/css/partials/*.scss";
var style = "assets/css/partials/style.scss";

const AUTOPREFIXER_BROWSERS = [
    "last 2 version",
    "> 1%",
    "ie >= 9",
    "ie_mob >= 10",
    "ff >= 30",
    "chrome >= 34",
    "safari >= 7",
    "opera >= 23",
    "ios >= 7",
    "android >= 4",
    "bb >= 10"
];

gulp.task("browser-sync", function() {
    browserSync.init({
        proxy: "massive.dev"
    });
});

// Shortcode handler
gulp.task("shortcodes", function() {
   return gulp.src(shortcodes)
       .pipe(plumberNotifier())
       .pipe(sass())
       .pipe(autoPrefixer(AUTOPREFIXER_BROWSERS))
       .pipe(csscomb())
       .pipe(concat("shortcodes.css"))
       .pipe(gulp.dest("assets/css"))
       .pipe(cssmin())
       .pipe(rename({suffix:".min"}))
       .pipe(gulp.dest("assets/css"));
});

// Style
gulp.task("style", function() {
    return gulp.src(style)
        .pipe(plumberNotifier())
        .pipe(sass())
        .pipe(autoPrefixer(AUTOPREFIXER_BROWSERS))
        .pipe(csscomb())
        .pipe(gulp.dest("assets/css"));
});

gulp.task("watch", ["browser-sync"], function() {
    gulp.watch(shortcodes, ["shortcodes"]);
    gulp.watch([partials,style], ["style"]);
});

gulp.task("default", ["browser-sync", "shortcodes", "style", "watch"]);