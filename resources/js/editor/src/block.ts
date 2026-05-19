export interface BlockProps
{
  style: string;
  className: string;
  id: string;
}

export interface ContainerProps extends BlockProps
{

}

export interface TextProps extends BlockProps
{

}

export interface ImageProps extends BlockProps
{
  src: string;
  alt: string;
}



type BlockTypeProps = {
  __Container: ContainerProps; 
  __Text: TextProps;
}

export type BlockType = keyof BlockTypeProps

export type Props = Partial<Record<keyof BlockType[keyof BlockType], string>>;


export default class Block {
  id: number;
  name: string
  node: string;
  type: keyof BlockType;
  props: Props;
  children: Block[];

  constructor(
    id: number, 
    name: string, 
    node: string, 
    type: keyof BlockType, 
    props: Props,
    children: Block[]
  ) {
    this.id = id;
    this.name = name;
    this.node = node;
    this.type = type;
    this.props = props;
    this.children = children;
  }

}
