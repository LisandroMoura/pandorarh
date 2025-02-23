import { describe, test, expect } from 'vitest'
import { mount } from '@vue/test-utils'
import Breadcrumb from '@/components/Breadcrumb.vue'



describe('Breadcrumb.vue', () => {
  test('renderiza o breadcrumb corretamente', () => {
    const currentPage = 'Funcionários da PandoraRH Listar  Novo'
    const wrapper = mount(Breadcrumb, {
        props: { currentPage: currentPage },
      });
   
    expect(wrapper.text()).toContain(currentPage)
    expect(wrapper.html()).toMatchSnapshot()
  })
})