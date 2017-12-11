import { mount } from 'vue-test-utils';
import chai from 'chai';
import ToDo from '../../resources/assets/js/components/ToDo.vue';

describe ('ToDo', () => {
  it('exists', () => {
    let wrapper = mount(ToDo);
    chai.assert.exists(wrapper, 'foo is neither `null` nor `undefined`');
  })
});
