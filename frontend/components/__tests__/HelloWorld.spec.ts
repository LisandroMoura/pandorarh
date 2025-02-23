import { describe, test, expect } from 'vitest'
import { shallowMount } from '@vue/test-utils'
import HelloWorld from '@/components/HelloWorld.vue'

describe('HelloWorld.vue', () => {
  test('renderiza a mensagem correta', () => {
    const msg = 'Bem-vindo ao Nuxt!'
    const wrapper = shallowMount(HelloWorld, {
      props: { msg }
    })
    
    expect(wrapper.text()).toContain(msg)
    expect(wrapper.html()).toMatchSnapshot()
  })
})