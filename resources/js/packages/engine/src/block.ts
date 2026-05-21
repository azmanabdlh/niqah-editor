export interface BlockContext<T extends BlockProps> {
  value: any;
  tagName: string; 
  props: T;
}

export interface BlockProps
{
  style: string;
  className: string;
  id: string;
}



export interface SectionProps extends BlockProps
{

}

export interface HeadingProps extends BlockProps
{
  
}

export interface ImageProps extends BlockProps
{
  src: string;
  alt: string;
}



type BlockTypeProps = {
  __Section: SectionProps; 
  __Heading: HeadingProps;
}

export type BlockType = keyof BlockTypeProps

export type Props = Partial<Record<keyof BlockType[keyof BlockType], string>>;


export default class Block {
  id: string;
  name: string
  node: string;
  type: BlockType;
  props: Props;
  value: any;
  children: Block[];

  constructor(
    id: number, 
    name: string, 
    node: string, 
    value: string,
    type: BlockType, 
    props: Props,
    children: Block[]
  ) {
    this.id = id;
    this.name = name;
    this.node = node;
    this.value = value;
    this.type = type;
    this.props = props;
    this.children = children;
  }

}
