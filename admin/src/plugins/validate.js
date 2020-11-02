import Vue from 'vue';
import { ValidationProvider,ValidationObserver, extend } from 'vee-validate';

// Add a rule.
extend('secret', {
  validate: value => value === 'example',
  message: 'This is not the magic word'
});

import * as rules from 'vee-validate/dist/rules';

Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule]);
});

// Register it globally
Vue.component('vp', ValidationProvider);
// Register it globally
Vue.component('vo', ValidationObserver);