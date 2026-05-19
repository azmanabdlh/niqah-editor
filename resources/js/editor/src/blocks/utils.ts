import { BlockProps } from "../block";

type Constructor<T = {}> = new (...args: any[]) => T;

export function NodeConfigurator<T extends Constructor>(Base: T) {
  return class extends Base {
    

    static mergeProps<K extends BlockProps>(
      node: HTMLElement,
      props: K,
    ): HTMLElement {
      Object.entries(props).forEach(([k,v]) => {
        node.setAttribute(k, v);
      })

      return node;
    }

  };
}