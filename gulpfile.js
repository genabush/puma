var gulp = require("gulp");

var sass = require("gulp-sass"),
    cssnano = require("gulp-cssnano"),
    autoprefixer = require('gulp-autoprefixer'),
    imagemin = require('gulp-imagemin'),
    concat = require("gulp-concat"),
    uglify = require("gulp-uglify"),
    rename = require("gulp-rename");
    sourcemaps = require('gulp-sourcemaps');

gulp.task("sass", function() {
    return gulp.src("scss/*.scss")
        // .pipe(concat('styles.scss'))
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
         }))
        .pipe(cssnano({zindex: false}))
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest("dist/css"));
});

// gulp.task("scripts", function scripts() {
//     return gulp.src([
//         "js/libs/*.js",
//         "js/*.js"
//     ])
//         .pipe(concat('main.js'))
//         .pipe(
//             uglify({
//             compress: {
//                 hoist_funs: false,
//                 hoist_vars: false}
//             })
//         )
//         .pipe(rename({ suffix: '.min' }))
//         .pipe(gulp.dest("dist/js"));
// });

// gulp.task('compress', function (cb) {
//     pump([
//             gulp.src('js/*.js'),
//             uglify(),
//             gulp.dest('dist/js')
//         ],
//         cb
//     );
// });

gulp.task('imgs', function() {
    return gulp.src("images/*.+(jpg|jpeg|png|gif)")
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{ removeViewBox: false }],
            interlaced: true
        }))
        .pipe(gulp.dest("dist/images"))
});

gulp.task("watch", function() {
    // gulp.watch("src/*.html", ["html"]);
    // gulp.watch(["js/libs/*.js","js/*.js"], ["scripts"]);
    gulp.watch("scss/*.scss", ["sass"]);
    gulp.watch("images/*.+(jpg|jpeg|png|gif)", ["imgs"]);
});

gulp.task("default", ["sass", "imgs", "watch"]);