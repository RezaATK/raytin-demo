
!function(e){"use strict";"function"==typeof define&&define.amd?define(["jquery","jquery-ui/ui/widget"],e):"object"==typeof exports?e(require("jquery"),require("./vendor/jquery.ui.widget")):e(window.jQuery)}(function(m){"use strict";function e(i){var r="dragover"===i;return function(e){e.dataTransfer=e.originalEvent&&e.originalEvent.dataTransfer;var t=e.dataTransfer;t&&-1!==m.inArray("Files",t.types)&&!1!==this._trigger(i,m.Event(i,{delegatedEvent:e}))&&(e.preventDefault(),r&&(t.dropEffect="copy"))}}var t;m.support.fileInput=!(new RegExp("(Android (1\\.[0156]|2\\.[01]))|(Windows Phone (OS 7|8\\.0))|(XBLWP)|(ZuneWP)|(WPDesktop)|(w(eb)?OSBrowser)|(webOS)|(Kindle/(1\\.0|2\\.[05]|3\\.0))").test(window.navigator.userAgent)||m('<input type="file"/>').prop("disabled")),m.support.xhrFileUpload=!(!window.ProgressEvent||!window.FileReader),m.support.xhrFormDataFileUpload=!!window.FormData,m.support.blobSlice=window.Blob&&(Blob.prototype.slice||Blob.prototype.webkitSlice||Blob.prototype.mozSlice),m.widget("blueimp.fileupload",{options:{dropZone:m(document),pasteZone:void 0,fileInput:void 0,replaceFileInput:!0,paramName:void 0,singleFileUploads:!0,limitMultiFileUploads:void 0,limitMultiFileUploadSize:void 0,limitMultiFileUploadSizeOverhead:512,sequentialUploads:!1,limitConcurrentUploads:void 0,forceIframeTransport:!1,redirect:void 0,redirectParamName:void 0,postMessage:void 0,multipart:!0,maxChunkSize:void 0,uploadedBytes:void 0,recalculateProgress:!0,progressInterval:100,bitrateInterval:500,autoUpload:!0,uniqueFilenames:void 0,messages:{uploadedBytes:"Uploaded bytes exceed file size"},i18n:function(i,e){return i=this.messages[i]||i.toString(),e&&m.each(e,function(e,t){i=i.replace("{"+e+"}",t)}),i},formData:function(e){return e.serializeArray()},add:function(e,t){if(e.isDefaultPrevented())return!1;(t.autoUpload||!1!==t.autoUpload&&m(this).fileupload("option","autoUpload"))&&t.process().done(function(){t.submit()})},processData:!1,contentType:!1,cache:!1,timeout:0},_promisePipe:(t=m.fn.jquery.split("."),1<Number(t[0])||7<Number(t[1])?"then":"pipe"),_specialOptions:["fileInput","dropZone","pasteZone","multipart","forceIframeTransport"],_blobSlice:m.support.blobSlice&&function(){return(this.slice||this.webkitSlice||this.mozSlice).apply(this,arguments)},_BitrateTimer:function(){this.timestamp=Date.now?Date.now():(new Date).getTime(),this.loaded=0,this.bitrate=0,this.getBitrate=function(e,t,i){var r=e-this.timestamp;return this.bitrate&&i&&!(i<r)||(this.bitrate=(t-this.loaded)*(1e3/r)*8,this.loaded=t,this.timestamp=e),this.bitrate}},_isXHRUpload:function(e){return!e.forceIframeTransport&&(!e.multipart&&m.support.xhrFileUpload||m.support.xhrFormDataFileUpload)},_getFormData:function(e){var i;return"function"===m.type(e.formData)?e.formData(e.form):m.isArray(e.formData)?e.formData:"object"===m.type(e.formData)?(i=[],m.each(e.formData,function(e,t){i.push({name:e,value:t})}),i):[]},_getTotal:function(e){var i=0;return m.each(e,function(e,t){i+=t.size||1}),i},_initProgressObject:function(e){var t={loaded:0,total:0,bitrate:0};e._progress?m.extend(e._progress,t):e._progress=t},_initResponseObject:function(e){if(e._response)for(var t in e._response)Object.prototype.hasOwnProperty.call(e._response,t)&&delete e._response[t];else e._response={}},_onProgress:function(e,t){var i,r;e.lengthComputable&&(i=Date.now?Date.now():(new Date).getTime(),t._time&&t.progressInterval&&i-t._time<t.progressInterval&&e.loaded!==e.total||(t._time=i,r=Math.floor(e.loaded/e.total*(t.chunkSize||t._progress.total))+(t.uploadedBytes||0),this._progress.loaded+=r-t._progress.loaded,this._progress.bitrate=this._bitrateTimer.getBitrate(i,this._progress.loaded,t.bitrateInterval),t._progress.loaded=t.loaded=r,t._progress.bitrate=t.bitrate=t._bitrateTimer.getBitrate(i,r,t.bitrateInterval),this._trigger("progress",m.Event("progress",{delegatedEvent:e}),t),this._trigger("progressall",m.Event("progressall",{delegatedEvent:e}),this._progress)))},_initProgressListener:function(i){var r=this,e=(i.xhr?i:m.ajaxSettings).xhr();e.upload&&(m(e.upload).on("progress",function(e){var t=e.originalEvent;e.lengthComputable=t.lengthComputable,e.loaded=t.loaded,e.total=t.total,r._onProgress(e,i)}),i.xhr=function(){return e})},_deinitProgressListener:function(e){e=(e.xhr?e:m.ajaxSettings).xhr();e.upload&&m(e.upload).off("progress")},_isInstanceOf:function(e,t){return Object.prototype.toString.call(t)==="[object "+e+"]"},_getUniqueFilename:function(e,t){return t[e=String(e)]?(e=e.replace(/(?: \(([\d]+)\))?(\.[^.]+)?$/,function(e,t,i){return" ("+(t?Number(t)+1:1)+")"+(i||"")}),this._getUniqueFilename(e,t)):(t[e]=!0,e)},_initXHRData:function(r){var n,o=this,e=r.files[0],t=r.multipart||!m.support.xhrFileUpload,s="array"===m.type(r.paramName)?r.paramName[0]:r.paramName;r.headers=m.extend({},r.headers),r.contentRange&&(r.headers["Content-Range"]=r.contentRange),t&&!r.blob&&this._isInstanceOf("File",e)||(r.headers["Content-Disposition"]='attachment; filename="'+encodeURI(e.uploadName||e.name)+'"'),t?m.support.xhrFormDataFileUpload&&(r.postMessage?(n=this._getFormData(r),r.blob?n.push({name:s,value:r.blob}):m.each(r.files,function(e,t){n.push({name:"array"===m.type(r.paramName)&&r.paramName[e]||s,value:t})})):(o._isInstanceOf("FormData",r.formData)?n=r.formData:(n=new FormData,m.each(this._getFormData(r),function(e,t){n.append(t.name,t.value)})),r.blob?n.append(s,r.blob,e.uploadName||e.name):m.each(r.files,function(e,t){var i;(o._isInstanceOf("File",t)||o._isInstanceOf("Blob",t))&&(i=t.uploadName||t.name,r.uniqueFilenames&&(i=o._getUniqueFilename(i,r.uniqueFilenames)),n.append("array"===m.type(r.paramName)&&r.paramName[e]||s,t,i))})),r.data=n):(r.contentType=e.type||"application/octet-stream",r.data=r.blob||e),r.blob=null},_initIframeSettings:function(e){var t=m("<a></a>").prop("href",e.url).prop("host");e.dataType="iframe "+(e.dataType||""),e.formData=this._getFormData(e),e.redirect&&t&&t!==location.host&&e.formData.push({name:e.redirectParamName||"redirect",value:e.redirect})},_initDataSettings:function(e){this._isXHRUpload(e)?(this._chunkedUpload(e,!0)||(e.data||this._initXHRData(e),this._initProgressListener(e)),e.postMessage&&(e.dataType="postmessage "+(e.dataType||""))):this._initIframeSettings(e)},_getParamName:function(e){var t=m(e.fileInput),r=e.paramName;return r?m.isArray(r)||(r=[r]):(r=[],t.each(function(){for(var e=m(this),t=e.prop("name")||"files[]",i=(e.prop("files")||[1]).length;i;)r.push(t),--i}),r.length||(r=[t.prop("name")||"files[]"])),r},_initFormSettings:function(e){e.form&&e.form.length||(e.form=m(e.fileInput.prop("form")),e.form.length||(e.form=m(this.options.fileInput.prop("form")))),e.paramName=this._getParamName(e),e.url||(e.url=e.form.prop("action")||location.href),e.type=(e.type||"string"===m.type(e.form.prop("method"))&&e.form.prop("method")||"").toUpperCase(),"POST"!==e.type&&"PUT"!==e.type&&"PATCH"!==e.type&&(e.type="POST"),e.formAcceptCharset||(e.formAcceptCharset=e.form.attr("accept-charset"))},_getAJAXSettings:function(e){e=m.extend({},this.options,e);return this._initFormSettings(e),this._initDataSettings(e),e},_getDeferredState:function(e){return e.state?e.state():e.isResolved()?"resolved":e.isRejected()?"rejected":"pending"},_enhancePromise:function(e){return e.success=e.done,e.error=e.fail,e.complete=e.always,e},_getXHRPromise:function(e,t,i){var r=m.Deferred(),n=r.promise();return t=t||this.options.context||n,!0===e?r.resolveWith(t,i):!1===e&&r.rejectWith(t,i),n.abort=r.promise,this._enhancePromise(n)},_addConvenienceMethods:function(e,i){function r(e){return m.Deferred().resolveWith(n,e).promise()}var n=this;i.process=function(e,t){return(e||t)&&(i._processQueue=this._processQueue=(this._processQueue||r([this]))[n._promisePipe](function(){return i.errorThrown?m.Deferred().rejectWith(n,[i]).promise():r(arguments)})[n._promisePipe](e,t)),this._processQueue||r([this])},i.submit=function(){return"pending"!==this.state()&&(i.jqXHR=this.jqXHR=!1!==n._trigger("submit",m.Event("submit",{delegatedEvent:e}),this)&&n._onSend(e,this)),this.jqXHR||n._getXHRPromise()},i.abort=function(){return this.jqXHR?this.jqXHR.abort():(this.errorThrown="abort",n._trigger("fail",null,this),n._getXHRPromise(!1))},i.state=function(){return this.jqXHR?n._getDeferredState(this.jqXHR):this._processQueue?n._getDeferredState(this._processQueue):void 0},i.processing=function(){return!this.jqXHR&&this._processQueue&&"pending"===n._getDeferredState(this._processQueue)},i.progress=function(){return this._progress},i.response=function(){return this._response}},_getUploadedBytes:function(e){e=e.getResponseHeader("Range"),e=e&&e.split("-"),e=e&&1<e.length&&parseInt(e[1],10);return e&&e+1},_chunkedUpload:function(o,e){o.uploadedBytes=o.uploadedBytes||0;var t,s,a=this,i=o.files[0],l=i.size,p=o.uploadedBytes,u=o.maxChunkSize||l,d=this._blobSlice,h=m.Deferred(),r=h.promise();return!(!(this._isXHRUpload(o)&&d&&(p||("function"===m.type(u)?u(o):u)<l))||o.data)&&(!!e||(l<=p?(i.error=o.i18n("uploadedBytes"),this._getXHRPromise(!1,o.context,[null,"error",i.error])):(s=function(){var r=m.extend({},o),n=r._progress.loaded;r.blob=d.call(i,p,p+("function"===m.type(u)?u(r):u),i.type),r.chunkSize=r.blob.size,r.contentRange="bytes "+p+"-"+(p+r.chunkSize-1)+"/"+l,a._trigger("chunkbeforesend",null,r),a._initXHRData(r),a._initProgressListener(r),t=(!1!==a._trigger("chunksend",null,r)&&m.ajax(r)||a._getXHRPromise(!1,r.context)).done(function(e,t,i){p=a._getUploadedBytes(i)||p+r.chunkSize,n+r.chunkSize-r._progress.loaded&&a._onProgress(m.Event("progress",{lengthComputable:!0,loaded:p-r.uploadedBytes,total:p-r.uploadedBytes}),r),o.uploadedBytes=r.uploadedBytes=p,r.result=e,r.textStatus=t,r.jqXHR=i,a._trigger("chunkdone",null,r),a._trigger("chunkalways",null,r),p<l?s():h.resolveWith(r.context,[e,t,i])}).fail(function(e,t,i){r.jqXHR=e,r.textStatus=t,r.errorThrown=i,a._trigger("chunkfail",null,r),a._trigger("chunkalways",null,r),h.rejectWith(r.context,[e,t,i])}).always(function(){a._deinitProgressListener(r)})},this._enhancePromise(r),r.abort=function(){return t.abort()},s(),r)))},_beforeSend:function(e,t){0===this._active&&(this._trigger("start"),this._bitrateTimer=new this._BitrateTimer,this._progress.loaded=this._progress.total=0,this._progress.bitrate=0),this._initResponseObject(t),this._initProgressObject(t),t._progress.loaded=t.loaded=t.uploadedBytes||0,t._progress.total=t.total=this._getTotal(t.files)||1,t._progress.bitrate=t.bitrate=0,this._active+=1,this._progress.loaded+=t.loaded,this._progress.total+=t.total},_onDone:function(e,t,i,r){var n=r._progress.total,o=r._response;r._progress.loaded<n&&this._onProgress(m.Event("progress",{lengthComputable:!0,loaded:n,total:n}),r),o.result=r.result=e,o.textStatus=r.textStatus=t,o.jqXHR=r.jqXHR=i,this._trigger("done",null,r)},_onFail:function(e,t,i,r){var n=r._response;r.recalculateProgress&&(this._progress.loaded-=r._progress.loaded,this._progress.total-=r._progress.total),n.jqXHR=r.jqXHR=e,n.textStatus=r.textStatus=t,n.errorThrown=r.errorThrown=i,this._trigger("fail",null,r)},_onAlways:function(e,t,i,r){this._trigger("always",null,r)},_onSend:function(e,t){t.submit||this._addConvenienceMethods(e,t);function i(){return s._sending+=1,a._bitrateTimer=new s._BitrateTimer,r=r||((n||!1===s._trigger("send",m.Event("send",{delegatedEvent:e}),a))&&s._getXHRPromise(!1,a.context,n)||s._chunkedUpload(a)||m.ajax(a)).done(function(e,t,i){s._onDone(e,t,i,a)}).fail(function(e,t,i){s._onFail(e,t,i,a)}).always(function(e,t,i){if(s._deinitProgressListener(a),s._onAlways(e,t,i,a),--s._sending,--s._active,a.limitConcurrentUploads&&a.limitConcurrentUploads>s._sending)for(var r=s._slots.shift();r;){if("pending"===s._getDeferredState(r)){r.resolve();break}r=s._slots.shift()}0===s._active&&s._trigger("stop")})}var r,n,o,s=this,a=s._getAJAXSettings(t);return this._beforeSend(e,a),this.options.sequentialUploads||this.options.limitConcurrentUploads&&this.options.limitConcurrentUploads<=this._sending?((t=1<this.options.limitConcurrentUploads?(o=m.Deferred(),this._slots.push(o),o[s._promisePipe](i)):(this._sequence=this._sequence[s._promisePipe](i,i),this._sequence)).abort=function(){return n=[void 0,"abort","abort"],r?r.abort():(o&&o.rejectWith(a.context,n),i())},this._enhancePromise(t)):i()},_onAdd:function(r,n){var o,e,s,t,a=this,l=!0,i=m.extend({},this.options,n),p=n.files,u=p.length,d=i.limitMultiFileUploads,h=i.limitMultiFileUploadSize,c=i.limitMultiFileUploadSizeOverhead,f=0,g=this._getParamName(i),_=0;if(!u)return!1;if(h&&void 0===p[0].size&&(h=void 0),(i.singleFileUploads||d||h)&&this._isXHRUpload(i))if(i.singleFileUploads||h||!d)if(!i.singleFileUploads&&h)for(s=[],o=[],t=0;t<u;t+=1)f+=p[t].size+c,(t+1===u||f+p[t+1].size+c>h||d&&d<=t+1-_)&&(s.push(p.slice(_,t+1)),(e=g.slice(_,t+1)).length||(e=g),o.push(e),_=t+1,f=0);else o=g;else for(s=[],o=[],t=0;t<u;t+=d)s.push(p.slice(t,t+d)),(e=g.slice(t,t+d)).length||(e=g),o.push(e);else s=[p],o=[g];return n.originalFiles=p,m.each(s||p,function(e,t){var i=m.extend({},n);return i.files=s?t:[t],i.paramName=o[e],a._initResponseObject(i),a._initProgressObject(i),a._addConvenienceMethods(r,i),l=a._trigger("add",m.Event("add",{delegatedEvent:r}),i)}),l},_replaceFileInput:function(e){var i=e.fileInput,r=i.clone(!0),t=i.is(document.activeElement);e.fileInputClone=r,m("<form></form>").append(r)[0].reset(),i.after(r).detach(),t&&r.trigger("focus"),m.cleanData(i.off("remove")),this.options.fileInput=this.options.fileInput.map(function(e,t){return t===i[0]?r[0]:t}),i[0]===this.element[0]&&(this.element=r)},_handleFileTreeEntry:function(t,i){function r(e){e&&!e.entry&&(e.entry=t),o.resolve([e])}var e,n=this,o=m.Deferred(),s=[],a=function(){e.readEntries(function(e){e.length?(s=s.concat(e),a()):(e=s,n._handleFileTreeEntries(e,i+t.name+"/").done(function(e){o.resolve(e)}).fail(r))},r)};return i=i||"",t.isFile?t._file?(t._file.relativePath=i,o.resolve(t._file)):t.file(function(e){e.relativePath=i,o.resolve(e)},r):t.isDirectory?(e=t.createReader(),a()):o.resolve([]),o.promise()},_handleFileTreeEntries:function(e,t){var i=this;return m.when.apply(m,m.map(e,function(e){return i._handleFileTreeEntry(e,t)}))[this._promisePipe](function(){return Array.prototype.concat.apply([],arguments)})},_getDroppedFiles:function(e){var t=(e=e||{}).items;return t&&t.length&&(t[0].webkitGetAsEntry||t[0].getAsEntry)?this._handleFileTreeEntries(m.map(t,function(e){var t;return e.webkitGetAsEntry?((t=e.webkitGetAsEntry())&&(t._file=e.getAsFile()),t):e.getAsEntry()})):m.Deferred().resolve(m.makeArray(e.files)).promise()},_getSingleFileInputFiles:function(e){var t=(e=m(e)).prop("entries");if(t&&t.length)return this._handleFileTreeEntries(t);if((t=m.makeArray(e.prop("files"))).length)void 0===t[0].name&&t[0].fileName&&m.each(t,function(e,t){t.name=t.fileName,t.size=t.fileSize});else{if(!(e=e.prop("value")))return m.Deferred().resolve([]).promise();t=[{name:e.replace(/^.*\\/,"")}]}return m.Deferred().resolve(t).promise()},_getFileInputFiles:function(e){return e instanceof m&&1!==e.length?m.when.apply(m,m.map(e,this._getSingleFileInputFiles))[this._promisePipe](function(){return Array.prototype.concat.apply([],arguments)}):this._getSingleFileInputFiles(e)},_onChange:function(t){var i=this,r={fileInput:m(t.target),form:m(t.target.form)};this._getFileInputFiles(r.fileInput).always(function(e){r.files=e,i.options.replaceFileInput&&i._replaceFileInput(r),!1!==i._trigger("change",m.Event("change",{delegatedEvent:t}),r)&&i._onAdd(t,r)})},_onPaste:function(e){var t=e.originalEvent&&e.originalEvent.clipboardData&&e.originalEvent.clipboardData.items,i={files:[]};t&&t.length&&(m.each(t,function(e,t){t=t.getAsFile&&t.getAsFile();t&&i.files.push(t)}),!1!==this._trigger("paste",m.Event("paste",{delegatedEvent:e}),i)&&this._onAdd(e,i))},_onDrop:function(t){t.dataTransfer=t.originalEvent&&t.originalEvent.dataTransfer;var i=this,e=t.dataTransfer,r={};e&&e.files&&e.files.length&&(t.preventDefault(),this._getDroppedFiles(e).always(function(e){r.files=e,!1!==i._trigger("drop",m.Event("drop",{delegatedEvent:t}),r)&&i._onAdd(t,r)}))},_onDragOver:e("dragover"),_onDragEnter:e("dragenter"),_onDragLeave:e("dragleave"),_initEventHandlers:function(){this._isXHRUpload(this.options)&&(this._on(this.options.dropZone,{dragover:this._onDragOver,drop:this._onDrop,dragenter:this._onDragEnter,dragleave:this._onDragLeave}),this._on(this.options.pasteZone,{paste:this._onPaste})),m.support.fileInput&&this._on(this.options.fileInput,{change:this._onChange})},_destroyEventHandlers:function(){this._off(this.options.dropZone,"dragenter dragleave dragover drop"),this._off(this.options.pasteZone,"paste"),this._off(this.options.fileInput,"change")},_destroy:function(){this._destroyEventHandlers()},_setOption:function(e,t){var i=-1!==m.inArray(e,this._specialOptions);i&&this._destroyEventHandlers(),this._super(e,t),i&&(this._initSpecialOptions(),this._initEventHandlers())},_initSpecialOptions:function(){var e=this.options;void 0===e.fileInput?e.fileInput=this.element.is('input[type="file"]')?this.element:this.element.find('input[type="file"]'):e.fileInput instanceof m||(e.fileInput=m(e.fileInput)),e.dropZone instanceof m||(e.dropZone=m(e.dropZone)),e.pasteZone instanceof m||(e.pasteZone=m(e.pasteZone))},_getRegExp:function(e){var t=e.split("/"),e=t.pop();return t.shift(),new RegExp(t.join("/"),e)},_isRegExpOption:function(e,t){return"url"!==e&&"string"===m.type(t)&&/^\/.*\/[igm]{0,3}$/.test(t)},_initDataAttributes:function(){var r=this,n=this.options,o=this.element.data();m.each(this.element[0].attributes,function(e,t){var i=t.name.toLowerCase();/^data-/.test(i)&&(i=i.slice(5).replace(/-[a-z]/g,function(e){return e.charAt(1).toUpperCase()}),t=o[i],r._isRegExpOption(i,t)&&(t=r._getRegExp(t)),n[i]=t)})},_create:function(){this._initDataAttributes(),this._initSpecialOptions(),this._slots=[],this._sequence=this._getXHRPromise(!0),this._sending=this._active=0,this._initProgressObject(this),this._initEventHandlers()},active:function(){return this._active},progress:function(){return this._progress},add:function(t){var i=this;t&&!this.options.disabled&&(t.fileInput&&!t.files?this._getFileInputFiles(t.fileInput).always(function(e){t.files=e,i._onAdd(null,t)}):(t.files=m.makeArray(t.files),this._onAdd(null,t)))},send:function(t){if(t&&!this.options.disabled){if(t.fileInput&&!t.files){var i,r,n=this,o=m.Deferred(),e=o.promise();return e.abort=function(){return r=!0,i?i.abort():(o.reject(null,"abort","abort"),e)},this._getFileInputFiles(t.fileInput).always(function(e){r||(e.length?(t.files=e,(i=n._onSend(null,t)).then(function(e,t,i){o.resolve(e,t,i)},function(e,t,i){o.reject(e,t,i)})):o.reject())}),this._enhancePromise(e)}if(t.files=m.makeArray(t.files),t.files.length)return this._onSend(null,t)}return this._getXHRPromise(!1,t&&t.context)}})});