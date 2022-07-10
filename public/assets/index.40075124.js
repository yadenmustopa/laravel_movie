const Q=function(){const e=document.createElement("link").relList;if(e&&e.supports&&e.supports("modulepreload"))return;for(const s of document.querySelectorAll('link[rel="modulepreload"]'))i(s);new MutationObserver(s=>{for(const o of s)if(o.type==="childList")for(const l of o.addedNodes)l.tagName==="LINK"&&l.rel==="modulepreload"&&i(l)}).observe(document,{childList:!0,subtree:!0});function n(s){const o={};return s.integrity&&(o.integrity=s.integrity),s.referrerpolicy&&(o.referrerPolicy=s.referrerpolicy),s.crossorigin==="use-credentials"?o.credentials="include":s.crossorigin==="anonymous"?o.credentials="omit":o.credentials="same-origin",o}function i(s){if(s.ep)return;s.ep=!0;const o=n(s);fetch(s.href,o)}};Q();function _(){}function q(t){return t()}function z(){return Object.create(null)}function x(t){t.forEach(q)}function X(t){return typeof t=="function"}function I(t,e){return t!=t?e==e:t!==e||t&&typeof t=="object"||typeof t=="function"}let k;function Z(t,e){return k||(k=document.createElement("a")),k.href=e,t===k.href}function Y(t){return Object.keys(t).length===0}let U=!1;function tt(){U=!0}function et(){U=!1}function d(t,e){t.appendChild(e)}function O(t,e,n){t.insertBefore(e,n||null)}function w(t){t.parentNode.removeChild(t)}function y(t){return document.createElement(t)}function A(t){return document.createTextNode(t)}function $(){return A(" ")}function nt(t,e,n,i){return t.addEventListener(e,n,i),()=>t.removeEventListener(e,n,i)}function h(t,e,n){n==null?t.removeAttribute(e):t.getAttribute(e)!==n&&t.setAttribute(e,n)}function it(t){return Array.from(t.childNodes)}function st(t,e){e=""+e,t.wholeText!==e&&(t.data=e)}let P;function F(t){P=t}const v=[];const G=[],S=[],W=[],rt=Promise.resolve();let j=!1;function ot(){j||(j=!0,rt.then(J))}function N(t){S.push(t)}const T=new Set;let E=0;function J(){const t=P;do{for(;E<v.length;){const e=v[E];E++,F(e),lt(e.$$)}for(F(null),v.length=0,E=0;G.length;)G.pop()();for(let e=0;e<S.length;e+=1){const n=S[e];T.has(n)||(T.add(n),n())}S.length=0}while(v.length);for(;W.length;)W.pop()();j=!1,T.clear(),F(t)}function lt(t){if(t.fragment!==null){t.update(),x(t.before_update);const e=t.dirty;t.dirty=[-1],t.fragment&&t.fragment.p(t.ctx,e),t.after_update.forEach(N)}}const C=new Set;let ct;function L(t,e){t&&t.i&&(C.delete(t),t.i(e))}function V(t,e,n,i){if(t&&t.o){if(C.has(t))return;C.add(t),ct.c.push(()=>{C.delete(t),i&&(n&&t.d(1),i())}),t.o(e)}else i&&i()}const bt=typeof window!="undefined"?window:typeof globalThis!="undefined"?globalThis:global;function K(t){t&&t.c()}function R(t,e,n,i){const{fragment:s,on_mount:o,on_destroy:l,after_update:a}=t.$$;s&&s.m(e,n),i||N(()=>{const f=o.map(q).filter(X);l?l.push(...f):x(f),t.$$.on_mount=[]}),a.forEach(N)}function M(t,e){const n=t.$$;n.fragment!==null&&(x(n.on_destroy),n.fragment&&n.fragment.d(e),n.on_destroy=n.fragment=null,n.ctx=[])}function ut(t,e){t.$$.dirty[0]===-1&&(v.push(t),ot(),t.$$.dirty.fill(0)),t.$$.dirty[e/31|0]|=1<<e%31}function H(t,e,n,i,s,o,l,a=[-1]){const f=P;F(t);const r=t.$$={fragment:null,ctx:null,props:o,update:_,not_equal:s,bound:z(),on_mount:[],on_destroy:[],on_disconnect:[],before_update:[],after_update:[],context:new Map(e.context||(f?f.$$.context:[])),callbacks:z(),dirty:a,skip_bound:!1,root:e.target||f.$$.root};l&&l(r.root);let g=!1;if(r.ctx=n?n(t,e.props||{},(c,b,...p)=>{const m=p.length?p[0]:b;return r.ctx&&s(r.ctx[c],r.ctx[c]=m)&&(!r.skip_bound&&r.bound[c]&&r.bound[c](m),g&&ut(t,c)),b}):[],r.update(),g=!0,x(r.before_update),r.fragment=i?i(r.ctx):!1,e.target){if(e.hydrate){tt();const c=it(e.target);r.fragment&&r.fragment.l(c),c.forEach(w)}else r.fragment&&r.fragment.c();e.intro&&L(t.$$.fragment),R(t,e.target,e.anchor,e.customElement),et(),J()}F(f)}let at;typeof HTMLElement=="function"&&(at=class extends HTMLElement{constructor(){super(),this.attachShadow({mode:"open"})}connectedCallback(){const{on_mount:t}=this.$$;this.$$.on_disconnect=t.map(q).filter(X);for(const e in this.$$.slotted)this.appendChild(this.$$.slotted[e])}attributeChangedCallback(t,e,n){this[t]=n}disconnectedCallback(){x(this.$$.on_disconnect)}$destroy(){M(this,1),this.$destroy=_}$on(t,e){const n=this.$$.callbacks[t]||(this.$$.callbacks[t]=[]);return n.push(e),()=>{const i=n.indexOf(e);i!==-1&&n.splice(i,1)}}$set(t){this.$$set&&!Y(t)&&(this.$$.skip_bound=!0,this.$$set(t),this.$$.skip_bound=!1)}});class B{$destroy(){M(this,1),this.$destroy=_}$on(e,n){const i=this.$$.callbacks[e]||(this.$$.callbacks[e]=[]);return i.push(n),()=>{const s=i.indexOf(n);s!==-1&&i.splice(s,1)}}$set(e){this.$$set&&!Y(e)&&(this.$$.skip_bound=!0,this.$$set(e),this.$$.skip_bound=!1)}}var ft="assets/svelte.d72399d3.png";function dt(t){let e,n,i,s,o;return{c(){e=y("button"),n=A("Clicks: "),i=A(t[0]),h(e,"class","svelte-1c7643s")},m(l,a){O(l,e,a),d(e,n),d(e,i),s||(o=nt(e,"click",t[1]),s=!0)},p(l,[a]){a&1&&st(i,l[0])},i:_,o:_,d(l){l&&w(e),s=!1,o()}}}function _t(t,e,n){let i=0;return[i,()=>{n(0,i+=1)}]}class ht extends B{constructor(e){super(),H(this,e,_t,dt,I,{})}}function pt(t){let e;return{c(){e=A(".")},m(n,i){O(n,e,i)},p:_,i:_,o:_,d(n){n&&w(e)}}}class mt extends B{constructor(e){super(),H(this,e,null,pt,I,{})}}function yt(t){let e,n,i,s,o,l,a,f,r,g,c,b,p,m;return e=new mt({}),r=new ht({}),{c(){K(e.$$.fragment),n=$(),i=y("main"),s=y("img"),l=$(),a=y("h1"),a.textContent="Hello world!",f=$(),K(r.$$.fragment),g=$(),c=y("p"),c.innerHTML=`Visit <a href="https://svelte.dev">svelte.dev</a> to learn how to build Svelte
    apps.`,b=$(),p=y("p"),p.innerHTML=`Check out <a href="https://github.com/sveltejs/kit#readme">SvelteKit</a> for
    the officially supported framework, also powered by Vite!`,Z(s.src,o=ft)||h(s,"src",o),h(s,"alt","Svelte Logo"),h(s,"class","svelte-1fm71xa"),h(a,"class","text-3xl font-bold underline svelte-1fm71xa"),h(c,"class","svelte-1fm71xa"),h(p,"class","svelte-1fm71xa"),h(i,"class","svelte-1fm71xa")},m(u,D){R(e,u,D),O(u,n,D),O(u,i,D),d(i,s),d(i,l),d(i,a),d(i,f),R(r,i,null),d(i,g),d(i,c),d(i,b),d(i,p),m=!0},p:_,i(u){m||(L(e.$$.fragment,u),L(r.$$.fragment,u),m=!0)},o(u){V(e.$$.fragment,u),V(r.$$.fragment,u),m=!1},d(u){M(e,u),u&&w(n),u&&w(i),M(r)}}}class gt extends B{constructor(e){super(),H(this,e,null,yt,I,{})}}const $t=new gt({target:document.getElementById("app")});