import{o as r,d as a,y as f,z as m,a as e,e as d,q as C,c as h,w as l,u as o,b as p,h as g,l as y,j as L}from"./app-9896f35b.js";import{M as b}from"./Modal-6529ac95.js";import{u as w}from"./quick-apply.store-da9cb4bf.js";import{_ as x}from"./TextAreaInput-bc36e97b.js";import{_ as k}from"./_plugin-vue_export-helper-c27b6911.js";const S={},E=s=>(f("data-v-f235f011"),s=s(),m(),s),I=E(()=>e("div",{class:"lds-spinner"},[e("div"),e("div"),e("div"),e("div"),e("div"),e("div"),e("div"),e("div"),e("div"),e("div"),e("div"),e("div")],-1)),V=[I];function B(s,t){return r(),a("div",null,V)}const M=k(S,[["render",B],["__scopeId","data-v-f235f011"]]),$=e("h2",{class:"h2 text-xl"},"Create Cover Letter",-1),j={key:0,class:"text-center"},z=e("p",{class:"mb-5"},"We're generating your application now...",-1),N={key:1,class:"space-y-6"},q={__name:"EditCoverLetter",setup(s){const t=w(),i=d(!1),c=d(!0),u=d(null);function v(){i.value=!0,t.application.userEditedCoverLetter=!0,setTimeout(()=>{u.value.focus()},50),c.value=!1}return C(()=>{t.generateCoverLetter()}),(A,n)=>(r(),h(b,{show:!0,onClose:o(t).cancelQuickApply,onConfirm:o(t).nextSlide},{header:l(()=>[$]),content:l(()=>[o(t).loading?(r(),a("div",j,[z,p(M)])):(r(),a("div",N,[p(x,{ref_key:"coverLetterInput",ref:u,class:g(["mt-1 block w-full",i.value?"":"opacity-75"]),rows:25,disabled:!i.value,modelValue:o(t).application.coverLetter,"onUpdate:modelValue":n[0]||(n[0]=_=>o(t).application.coverLetter=_),required:""},null,8,["class","disabled","modelValue"])]))]),buttons:l(()=>[c.value&&!o(t).loading?(r(),a("button",{key:0,onClick:n[1]||(n[1]=y(_=>v(),["stop"])),class:"transition duration-100 bg-green-600 hover:bg-green-500 text-white font-medium focus:outline-none py-2 rounded-md px-5 mr-6"}," Edit Cover Letter ")):L("",!0)]),_:1},8,["onClose","onConfirm"]))}},U=Object.freeze(Object.defineProperty({__proto__:null,default:q},Symbol.toStringTag,{value:"Module"}));export{U as E,M as L,q as _};
