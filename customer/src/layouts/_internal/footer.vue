<template>
<div class="e-footer-inner e-pl-10 e-pr-10">
<div class="e-reputation e-mb-20">
        <div class="e-reputation-item e-p-10" v-for="(m,i) in resource.messages" :key="i">
            <div class="e-icon e-m-10" v-html="m.icon"></div>
            <div class="center">
                <div class="e-title">{{m.title}}</div>
                <div class="e-mt-5">{{m.text}}</div>
            </div>
        </div>
    </div>
        <div class="e-newsletter" style="text-align:center;">
            <h5>{{resource.newsletter.title}}</h5>
            <ul class="e-mt-10 e-center-column" >
                <li class="e-center e-mb-10">
                    <span class="e-title" style="max-width:400px">
                        {{resource.newsletter.meaasge}}
                    </span>
                </li>
                <li class="e-mt-10">
                    <div class="e-subscribe-box" >
                        <button class="e-subscribe-btn">subscribe</button>
                        <input class="e-subscribe-input" type="text" placeholder="Type your email">
                    </div>
                </li>
            </ul>
        </div>
    <div class="e-footer-middle">
    <div class="e-left">
        <ul>
            <li class="e-list-item e-center">
                <img :src="resource.contact.logo" height="50">
            </li>
            <li class="e-list-item e-center e-mt-15">
                <span class="e-mr-10">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" />
                    </svg>
                </span>
                <span class=" e-title"> {{resource.contact.address}}</span>
            </li>
            <li class="e-list-item e-center e-mt-5">
                <span class="e-mr-10">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3,4C1.89,4 1,4.89 1,6V18A2,2 0 0,0 3,20H14.09C14.03,19.67 14,19.34 14,19A6,6 0 0,1 20,13C20.34,13 20.67,13.03 21,13.09V6C21,4.89 20.1,4 19,4H3M3,6L11,11L19,6V8L11,13L3,8V6M19,15V18H16V20H19V23H21V20H24V18H21V15H19Z" />
                    </svg>
                </span>
                <span class=" e-title">
                    {{resource.contact.email}}
                </span>
            </li>
            <li class="e-list-item e-center e-mt-5">
                <span class="e-mr-10">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22,17H18V10H22M23,8H17A1,1 0 0,0 16,9V19A1,1 0 0,0 17,20H23A1,1 0 0,0 24,19V9A1,1 0 0,0 23,8M4,6H22V4H4A2,2 0 0,0 2,6V17H0V20H14V17H4V6Z" />
                    </svg>
                </span>
               <span class=" e-title">
                    {{resource.contact.phone}}
               </span>
            </li>
            <li class="e-center e-mt-10">
                <a class="e-ml-5 e-mr-5" v-for="(s,i) in resource.contact.socials" :key="i" :href="s.url">
                    <img :src="s.thumb" style="max-height:30px;">
                </a>
            </li>
        </ul>
    </div>
    <div class="e-middle">
        <template v-for="(group,i) in resource.link_group"  >
        <div  class="e-center-column" v-if="group.links.length">
            <h5>{{group.title}}</h5>
            <ul class="e-mt-10">
                <li v-for="(link,index) in group.links" :key="index" class="e-center">
                    <a class="e-title" :href="link.url">{{link.title}}</a></li>
            </ul>
        </div>
        </template>
    </div>
    </div>
    <div class="e-footer-end" >
        <button class="e-click-to-up-box e-p-5" id="click-to-up">
<svg style="width:24px;height:24px" viewBox="0 0 24 24">
    <path fill="currentColor" d="M2,20V22H22V20H13V5.83L18.5,11.33L19.92,9.92L12,2L4.08,9.92L5.5,11.33L11,5.83V20H2Z" />
</svg>
        </button>
        <span>
            Copyright © 2020 mbazaer all rights reserved. Powered by saifuul
        </span>
        <ul>
            <a href="s">f</a>
             <a href="s">f</a>
              <a href="s">f</a>
        </ul>
    </div>


</div>
</template>

<script>
export default {
    props: {

    },
    data(){
        return {
            resource:{}
        }
    },
    created(){
       this.resource = this.$root.res.footer;
        console.log(this.$root.res.footer)
    }
}
</script>

<style>

</style>
