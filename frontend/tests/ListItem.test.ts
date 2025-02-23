import { describe, test, expect, vi, beforeEach } from "vitest";
import { mount } from "@vue/test-utils";

import { setupMocks } from '@/tests/moks/setupMocks'

import ListItem from "@/components/ListItem.vue";

describe("ListItem", () => {
  const mockProps = {
    id: 2,
    nome: "João Silva",
    data_nascimento: "1991-01-01",
  };

  beforeEach(() => {
    setupMocks() 
    vi.clearAllMocks()
    global.confirm = vi.fn(() => true)
  })

  test("renderiza corretamente as props", async () => {
    const wrapper = await mount(ListItem, { props: mockProps });

    expect(wrapper.text()).toContain(`id: ${mockProps.id}`);
    expect(wrapper.text()).toContain(mockProps.nome);
    expect(wrapper.text()).toContain(
      `Nascimento: ${mockProps.data_nascimento}`
    );
  });

  test("renderiza os botões de ação", () => {
    const wrapper = mount(ListItem, { props: mockProps });
    const buttons = wrapper.findAll("button");
    expect(buttons).toHaveLength(3);
    // console.dir(buttons)
    expect(buttons[0].text()).toBe("Ver");
    expect(buttons[1].text()).toBe("Editar");
    expect(buttons[2].text()).toBe("Excluir");
  });  

});
