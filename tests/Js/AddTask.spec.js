import { mount } from 'vue-test-utils';
import chai from 'chai';
import AddTask from '../../resources/assets/js/components/AddTask.vue';

describe ('ToDo', () => {
  it('exists', () => {
    let wrapper = mount(AddTask);
    chai.assert.exists(wrapper, 'foo is neither `null` nor `undefined`');
  })
});
