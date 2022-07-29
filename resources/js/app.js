require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

require("@tailwindcss/typography");
require('trumbowyg');
require('jquery-resizable-dom');
require('trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js');
require('trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js');
require('trumbowyg/dist/plugins/emoji/trumbowyg.emoji.min.js');
require('trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js');
require('trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js');
require('trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.min.js');
require('trumbowyg/dist/plugins/specialchars/trumbowyg.specialchars.min.js');
require('trumbowyg/dist/langs/ja.min.js');

import swal from 'sweetalert2';
window.Swal = swal;
import toastr from 'toastr';
window.toastr = toastr;