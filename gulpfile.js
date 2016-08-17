/*--	GulpJS Workflow --*/
'use strict';

var settings = {

	browserSync: {
		// browser to use -> string | array
		useBrowser: 'google chrome',
		// local URL | false to serve static -> string | boolean
		useProxy: 'false'
	},

	errors: {
		// system notification on error -> boolean
		notifications: true,
		// system sound on error -> boolean
		sounds: true
	},

	keys: {
		// tinypng API key (https://tinypng.com/developers) -> string | boolean
		tinypng: '72x6PhZJE9-xHyrD4XqaE-ztMr_vhBzh'
	}
};

/* requires:
-----------------------*/
var beep = (settings.errors.sounds) ? require('beepbeep') : false;
var browserSync = require('browser-sync');
var colors = require('colors');
var gulp = require('gulp');
var concat = require('gulp-concat');
var fontgen = require('gulp-fontgen');
var once = require('gulp-once');
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');
var jsonEditor = require('gulp-json-editor');
var plumber = require('gulp-plumber');
var postcss = require('gulp-postcss');
var rename = require('gulp-rename');
var replace = require('gulp-replace');
var sass = require('gulp-sass');
var svgSprite = require('gulp-svg-sprite');
var svgmin = require('gulp-svgmin');
var tinypng = require('gulp-tinypng-compress');
var uglify = require('gulp-uglify');
var jshintStylish = require('jshint-stylish');
var notifier = (settings.errors.notifications) ? require('node-notifier') : false;

/* postcss processors:
-----------------------*/
var pcss = {
	autoprefixer: require('autoprefixer'),
	declarationSorter: require('css-declaration-sorter'),
	mqpacker: require('css-mqpacker'),
	cssnano: require('cssnano'),
	customMedia: require('postcss-custom-media'),
	positionAlt: require('postcss-position-alt'),
	pxtorem: require('postcss-pxtorem'),
	shortColor: require('postcss-short-color'),
	size: require('postcss-size')
};


/* compile sass/pcss
-----------------------*/
gulp.task('css', function() {
	var processors = [
		pcss.positionAlt,
		pcss.shortColor,
		pcss.size,
		pcss.pxtorem,
		pcss.customMedia,
		pcss.mqpacker({sort: true}),
		pcss.declarationSorter({order: 'smacss'}),
		pcss.autoprefixer({browsers: ['last 2 versions', 'ie 9']}),
		pcss.cssnano
	];

	return gulp.src('./sass/style.scss')
		.pipe(plumber(function(err) {
			var errPath = err.relativePath.toString() + ':' + err.line.toString();
			var errMsg = err.messageOriginal.toString();
			if (beep) beep();
			if (notifier) notifier.notify({title: errPath, message: errMsg});
		 	console.log(errMsg);
		 	this.emit('end');
		}))
		.pipe(sass())
		.pipe(postcss(processors))
		.pipe(gulp.dest('./'));
});


/* js minification
-----------------------*/
gulp.task('js', function() {
	return gulp.src('./js/scripts.js')
		.pipe(plumber(function(err) {
			var errMsg = err.toString();
			if (beep) beep();
			if (notifier) notifier.notify({title: 'JavaScript', message: errMsg});
		 	this.emit('end');
		}))
		.pipe(jshint())
		.pipe(uglify())
		.pipe(rename('scripts.min.js'))
		.pipe(gulp.dest('./js/'));
});


/* icons
-----------------------*/
// svg icon sprite
gulp.task('icons', function() {
	return gulp.src('./icons/_src/**/*.svg')
		.pipe(svgSprite({
			shape: {id: {separator: '__'}},
			svg: {rootAttributes: {style: 'display:none'}},
			mode: {symbol: true}
		}))
		.pipe(rename('sprite.svg'))
		.pipe(gulp.dest('./icons/'));
});


/* generate fonts
-----------------------*/
// create font files (eot,woff,woff2,svg,ttf)
gulp.task('fonts-gen', function() {
	return gulp.src('./fonts/*.{otf,ttf}')
		.pipe(once({file: './fonts/.font-sigs'}))
		.pipe(fontgen({
			dest: './fonts/',
			css_fontpath: 'fonts/',
			collate: true
		}));
});

// replace font-weight
gulp.task('fonts-replace', ['fonts-gen'], function() {
	return gulp.src('./fonts/**/*.css')
		.pipe(once({file: './fonts/.font-sigs'}))
		.pipe(replace(/font-weight:.+/g, 'font-weight: normal;'))
		.pipe(gulp.dest('./fonts/'));
});

// manage fontface css
gulp.task('fonts', ['fonts-replace'], function() {
	return gulp.src('./fonts/**/*.css')
		.pipe(concat('_fontface.scss'))
		.pipe(gulp.dest('./sass/assets/'));
});


/* optimize images
-----------------------*/
// minify svg image assets
gulp.task('images-svg', function() {
	return gulp.src('./images/**/*.svg')
		.pipe(once({file: './images/.svg-sigs'}))
		.pipe(svgmin())
		.pipe(gulp.dest('./images/'));
});

// optimize png and jpg image assets
gulp.task('images', ['images-svg'], function () {
	if (settings.keys.tinypng) {
		return gulp.src('./images/**/*.{png,jpg,jpeg}')
			.pipe(tinypng({
				key: settings.keys.tinypng,
				sigFile: './images/.image-sigs',
				sameDest: true,
				summarize: true,
				log: true
			}))
			.pipe(gulp.dest('./images/'));
	} else {
		if (beep) beep();
		if (notifier) notifier.notify({title: 'TinyPNG', message: 'You didn\'t provide your TinyPNG API key @ gulpfile.js:22'});
		console.log('[' + 'WARN'.yellow + '] You didn\'t provide your ' + 'TinyPNG API key'.underline.red + ' @ ' + 'gulpfile.js:22'.cyan);
		return false;
	}
});

// combine assets tasks
gulp.task('assets', ['fonts', 'icons']);


/* build tasks
-----------------------*/
// process code
gulp.task('build', ['js', 'css']);

// process code and assets
gulp.task('build-full', ['js', 'assets', 'css']);


/* browser sync
-----------------------*/
gulp.task('sync', function() {
	browserSync.reload();
});

// set to default task
gulp.task('default', ['build'], function () {
	var browserSyncSettings = (settings.browserSync.useProxy) ? {
		browser: settings.browserSync.useBrowser,
  	proxy: settings.browserSync.useProxy
  }:{
  	browser: settings.browserSync.useBrowser,
  	server: './'
  };

	browserSync.init(browserSyncSettings);

  gulp.watch('js/scripts.js', ['js', 'sync']);
  gulp.watch('sass/**/*.scss', ['css', 'sync']);
  gulp.watch('**/*.{html,php}', ['sync']);
});


gulp.task('dev', ['build'], function() {
	gulp.watch('js/scripts.js', ['js']);
	gulp.watch('sass/**/*.scss', ['css']);
});
