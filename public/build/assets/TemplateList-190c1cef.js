import{q as x,o as r,d as i,b as n,u as s,a as t,l as _,F as h,s as b,j as c,c as m,t as a,f as l}from"./app-9896f35b.js";import{P as y}from"./Pagination-bc88e3a2.js";import{f as p}from"./DateService-6d788d4a.js";import{u}from"./templates.store-6f7b45f6.js";import w from"./TemplateFilters-dbc0a12b.js";import f from"./EditTemplateForm-d44be8d3.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./user-flashes-store.store-3e90a595.js";import"./ApiService-2f26cf17.js";import"./InputLabel-9e7df670.js";import"./TextInput-60dc7526.js";import"./DateRangeInput-3dece17e.js";import"./Modal-6529ac95.js";const v={class:"mt-6"},k=t("h2",{class:"text-xl font-semibold leading-tight text-gray-700"},"Templates",-1),C={class:"flex justify-between items-center my-5 py-5 px-3 bg-white rounded-md"},T={class:"py-4"},V={class:"bg-white inline-block min-w-full overflow-hidden rounded-lg shadow"},B={class:"min-w-full leading-normal"},N=t("thead",null,[t("tr",null,[t("th",{class:"px-4 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," ID "),t("th",{class:"px-4 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Status "),t("th",{class:"px-4 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Location "),t("th",{class:"px-4 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Content "),t("th",{class:"px-4 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Updated "),t("th",{class:"px-4 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Created "),t("th",{class:"text-center px-4 py-3 text-xs font-semibold tracking-wider text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200"}," Actions ")])],-1),A={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},M={class:"flex items-center"},z={class:"mx-auto"},D={class:"text-gray-900 whitespace-nowrap"},E={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},F={class:"flex items-center"},L={class:"mx-auto"},P={class:"text-gray-900 whitespace-nowrap"},H={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},S={class:"flex items-center"},$={class:"mx-auto"},j={class:"text-gray-900 whitespace-nowrap"},q={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},I={class:"text-gray-900 whitespace-nowrap"},U={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},G={class:"flex items-center"},J={class:"mx-auto"},K={class:"text-gray-900 whitespace-nowrap"},O={class:"text-xs leading-5 text-gray-500"},Q={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},R={class:"flex items-center"},W={class:"mx-auto"},X={class:"text-gray-900 whitespace-nowrap"},Y={class:"text-xs leading-5 text-gray-500"},Z={class:"px-4 py-4 text-sm bg-white border-b border-gray-200"},tt={class:"flex justify-around"},et=["onClick"],st=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5 text-blue-500",viewBox:"0 0 20 20",fill:"currentColor"},[t("path",{d:"M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"}),t("path",{"fill-rule":"evenodd",d:"M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z","clip-rule":"evenodd"})],-1),ot=[st],at=["onClick"],rt=t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-5 w-5 text-red-700",viewBox:"0 0 20 20",fill:"currentColor"},[t("path",{"fill-rule":"evenodd",d:"M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z","clip-rule":"evenodd"})],-1),it=[rt],dt={class:"py-5 pr-5"},kt={__name:"TemplateList",setup(nt){const o=u();return x(async()=>{o.getTemplates()}),(ct,d)=>(r(),i("div",v,[k,n(s(f)),t("div",null,[t("div",C,[n(s(w)),t("div",null,[t("button",{onClick:d[0]||(d[0]=_((...e)=>s(o).triggerEditTemplateForm&&s(o).triggerEditTemplateForm(...e),["stop"])),class:"transition duration-100 bg-indigo-500 hover:bg-indigo-400 text-white font-medium focus:outline-none py-2 rounded-md px-5 mr-6"}," Create New Template ")])]),t("div",T,[t("div",V,[t("table",B,[N,t("tbody",null,[s(o).templates?(r(!0),i(h,{key:0},b(s(o).templates,e=>(r(),i("tr",null,[t("td",A,[t("div",M,[t("div",z,[t("p",D,a(e.id),1)])])]),t("td",E,[t("div",F,[t("div",L,[t("p",P,a(e.statusName),1)])])]),t("td",H,[t("div",S,[t("div",$,[t("p",j,a(e.locationName),1)])])]),t("td",q,[t("p",I,a(e.content&&e.content.length>65?e.content.substring(0,65)+"...":e.content),1)]),t("td",U,[t("div",G,[t("div",J,[t("p",K,[l(a(e.updatedAt?s(p)(e.updatedAt):"no date")+" ",1),t("div",O,a(e.updatedBy),1)])])])]),t("td",Q,[t("div",R,[t("div",W,[t("p",X,[l(a(e.createdAt?s(p)(e.createdAt):"no date")+" ",1),t("div",Y,a(e.createdBy),1)])])])]),t("td",Z,[t("div",tt,[t("button",{class:"mx-2 rounded-md",onClick:g=>s(o).triggerEditTemplateForm(e)},ot,8,et),t("button",{class:"mx-2 rounded-md",onClick:g=>s(o).deleteTemplate(e.id)},it,8,at)])])]))),256)):c("",!0)])]),t("div",dt,[s(o).paginationData?(r(),m(s(y),{key:0,"pagination-data":s(o).paginationData,onChangePage:s(o).handlePaginationEvent},null,8,["pagination-data","onChangePage"])):c("",!0)])])])])]))}};export{kt as default};
