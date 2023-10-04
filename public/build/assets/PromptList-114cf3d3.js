import{P as p}from"./Pagination-bc88e3a2.js";import{f as g}from"./DateService-6d788d4a.js";import{u as _}from"./prompts.store-40e97097.js";import h from"./PromptFilters-c4f5a322.js";import b from"./ViewPromptForm-f8d70a4b.js";import{q as m,o as r,d as a,b as c,u as e,a as t,F as x,s as y,j as i,c as u,t as n}from"./app-9896f35b.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./user-flashes-store.store-3e90a595.js";import"./ApiService-2f26cf17.js";import"./InputLabel-9e7df670.js";import"./TextInput-60dc7526.js";import"./DateRangeInput-3dece17e.js";import"./TextAreaInput-bc36e97b.js";const w={class:"mt-6"},f=t("h2",{class:"text-xl font-semibold leading-tight text-gray-700"},"Prompts",-1),v={key:0},k={class:"my-5 py-5 px-3 bg-white rounded-md"},P={class:"py-4"},C={class:"bg-white inline-block min-w-full overflow-hidden rounded-lg shadow"},B={class:"min-w-full leading-normal"},D=t("thead",null,[t("tr",null,[t("th",{class:"px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," ID "),t("th",{class:"px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Content "),t("th",{class:"px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Created by "),t("th",{class:"px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Created at "),t("th",{class:"text-center px-5 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Actions ")])],-1),V={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},F={class:"flex items-center"},A={class:"ml-3"},L={class:"text-gray-900 whitespace-nowrap"},M={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},N={class:"text-gray-900 whitespace-nowrap"},S={class:"td-class text-center"},$={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},j={class:"text-gray-900 whitespace-nowrap"},z={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},E={class:"text-gray-900 whitespace-nowrap"},H={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},q={class:"flex justify-around"},I=["onClick"],G=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5 text-blue-500",viewBox:"0 0 20 20",fill:"currentColor"},[t("path",{d:"M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"}),t("path",{"fill-rule":"evenodd",d:"M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z","clip-rule":"evenodd"})],-1),J=[G],K={class:"py-5 pr-5"},it={__name:"PromptList",setup(O){const s=_();m(async()=>{s.getPrompts()});const l=function(d){s.editingPrompt=d,s.showPromptForm=!0};return(d,Q)=>(r(),a("div",w,[f,c(e(b)),e(s).showPromptForm?i("",!0):(r(),a("div",v,[t("div",k,[c(e(h))]),t("div",P,[t("div",C,[t("table",B,[D,t("tbody",null,[e(s).prompts?(r(!0),a(x,{key:0},y(e(s).prompts,o=>(r(),a("tr",null,[t("td",V,[t("div",F,[t("div",A,[t("p",L,n(o.id),1)])])]),t("td",M,[t("p",N,[t("td",S,n(o.content&&o.content.length>100?o.content.substring(0,100)+"...":o.content),1)])]),t("td",$,[t("p",j,n(o.createdBy),1)]),t("td",z,[t("p",E,n(o.createdAt?e(g)(o.createdAt):"no date"),1)]),t("td",H,[t("div",q,[t("button",{class:"mx-2 rounded-md",onClick:R=>l(o)},J,8,I)])])]))),256)):i("",!0)])]),t("div",K,[e(s).paginationData?(r(),u(e(p),{key:0,"pagination-data":e(s).paginationData,onChangePage:e(s).handlePaginationEvent},null,8,["pagination-data","onChangePage"])):i("",!0)])])])]))]))}};export{it as default};
