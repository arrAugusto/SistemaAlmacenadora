USE [Integrada]
GO
/****** Object:  Table [dbo].[aduanas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[aduanas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[claveAduana] [text] NOT NULL,
	[Aduana] [text] NOT NULL,
 CONSTRAINT [PK_aduanas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[agrupacionEmpresas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[agrupacionEmpresas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idEmpGp] [int] NOT NULL,
	[idNitVeh] [int] NOT NULL,
 CONSTRAINT [PK_agrupacionEmpresas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ajustesContables]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ajustesContables](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NULL,
	[ajusteCif] [float] NULL,
	[ajusteImpuesto] [float] NULL,
	[fechaAjuste] [date] NULL,
 CONSTRAINT [PK_ajustesContables] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[almacenajes]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[almacenajes](
	[idTarifa] [int] IDENTITY(1,1) NOT NULL,
	[idServicio] [int] NOT NULL,
	[idUsuarioCliente] [int] NOT NULL,
	[baseCalculo] [text] NOT NULL,
	[calculoSobre] [text] NOT NULL,
	[periodoCalculo] [text] NOT NULL,
	[Moneda] [text] NOT NULL,
	[valorTarifa] [float] NOT NULL,
	[aplicaServicio] [int] NOT NULL,
	[Estado] [int] NOT NULL,
	[fechaCotizacion] [date] NOT NULL,
	[fechaInicio] [date] NOT NULL,
	[numeroSerie] [int] NOT NULL,
 CONSTRAINT [PK_ALMACENAJES0] PRIMARY KEY CLUSTERED 
(
	[idTarifa] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[areasBodegas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[areasBodegas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idBodega] [int] NULL,
	[nombreArea] [text] NULL,
	[descripcionArea] [text] NULL,
	[tiempo] [int] NULL,
	[fechaVencimiento] [date] NULL,
 CONSTRAINT [PK_areasBodegas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[areasVisitada]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[areasVisitada](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[empresaVisitada] [text] NOT NULL,
 CONSTRAINT [PK_areasVisitada] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[autoDeAnulaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[autoDeAnulaIng](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[token] [text] NOT NULL,
	[fecha] [datetime] NOT NULL,
	[comentario] [text] NOT NULL,
	[usuario] [int] NOT NULL,
	[estado] [int] NOT NULL,
 CONSTRAINT [PK_autoDeAnulaIng] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[bitacoraIngresos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[bitacoraIngresos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[transaccion] [text] NOT NULL,
	[idUsuario] [int] NOT NULL,
	[fecha] [datetime] NOT NULL,
 CONSTRAINT [PK_bitacoraIngresos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[bitacoraRetiroCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[bitacoraRetiroCalculo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idOpera] [int] NOT NULL,
	[transaccion] [text] NOT NULL,
	[idUsuario] [int] NOT NULL,
	[tipo] [int] NOT NULL,
	[fecha] [datetime] NOT NULL,
 CONSTRAINT [PK_bitacoraRetiroCalculo] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[bodegas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[bodegas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[areasAutorizadas] [text] NOT NULL,
	[numeroIdentidad] [int] NOT NULL,
	[dependencia] [int] NOT NULL,
	[idVinculo] [int] NULL,
 CONSTRAINT [PK_BODEGAS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[calculosNormal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[calculosNormal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[idDetalle] [int] NOT NULL,
	[idNitSalida] [int] NOT NULL,
	[poliza] [text] NOT NULL,
	[regimen] [text] NOT NULL,
	[valorAduanT] [float] NOT NULL,
	[tipoCambio] [float] NOT NULL,
	[valorCif] [float] NOT NULL,
	[valorImpuesto] [float] NOT NULL,
	[pesoKG] [float] NOT NULL,
	[cantidadBultos] [float] NOT NULL,
	[fechaCalculo] [datetime] NOT NULL,
	[fechaParaCalculo] [datetime] NOT NULL,
 CONSTRAINT [PK_calculosNormal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[categorias]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[categorias](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[area] [text] NOT NULL,
 CONSTRAINT [PK_categorias] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[chasisVehiculosNuevos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[chasisVehiculosNuevos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[chasis] [text] NOT NULL,
	[tipoVehiculo] [int] NULL,
	[lineaVehiculo] [int] NULL,
	[ubicacion] [int] NULL,
	[idRet] [int] NULL,
	[estado] [int] NOT NULL,
 CONSTRAINT [PK_chasisVehiculosNuevos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[clientesSinTarifa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[clientesSinTarifa](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[identBodega] [int] NOT NULL,
	[idNit] [int] NOT NULL,
	[idUsuario] [int] NOT NULL,
	[comentarios] [text] NULL,
	[estado] [int] NOT NULL,
	[ejecutivo] [int] NULL,
 CONSTRAINT [PK_CLIENTESSINTARIFA] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobroAlteracionServicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobroAlteracionServicios](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[rubroServiciosAlteracion] [float] NOT NULL,
 CONSTRAINT [PK_cobroAlteracionServicios] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobroAlteracionServiciosFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobroAlteracionServiciosFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[rubroServiciosAlteracion] [float] NOT NULL,
 CONSTRAINT [PK_cobroAlteracionServiciosFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobroDescuentosAutorizados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobroDescuentosAutorizados](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroDescuento] [text] NOT NULL,
 CONSTRAINT [PK_cobroDescuentosAutorizados] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobroDescuentosAutorizadosFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobroDescuentosAutorizadosFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroDescuento] [text] NOT NULL,
 CONSTRAINT [PK_cobroDescuentosAutorizadosFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobroOtrosGastos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobroOtrosGastos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[idOtroGst] [int] NOT NULL,
	[rubroOtrosGastos] [float] NOT NULL,
 CONSTRAINT [PK_cobroOtrosGastos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobroOtrosGastosFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobroOtrosGastosFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[idOtroGst] [int] NOT NULL,
	[rubroOtrosGastos] [float] NOT NULL,
 CONSTRAINT [PK_cobroOtrosGastosFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosAlmacenajes]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosAlmacenajes](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroAlmacenaje] [float] NOT NULL,
 CONSTRAINT [PK_cobrosAlmacenajes] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosAlmacenajesFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosAlmacenajesFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRegistroCobro] [int] NULL,
	[idIngreso] [int] NOT NULL,
	[rubroAlmacenaje] [float] NOT NULL,
	[estado] [int] NULL,
	[fechaCobro] [date] NULL,
	[fechaEmision] [datetime] NULL,
 CONSTRAINT [PK_cobrosAlmacenajesFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosGastosAdmin]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosGastosAdmin](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroGastosAdmin] [float] NOT NULL,
 CONSTRAINT [PK_cobrosGstsAdmin] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosGastosAdminFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosGastosAdminFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRegistroCobro] [int] NOT NULL,
	[idIngreso] [int] NOT NULL,
	[rubrosGtoAdmin] [float] NOT NULL,
 CONSTRAINT [PK_cobrosGastosAdmin] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosManejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosManejo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubrosManejos] [float] NOT NULL,
 CONSTRAINT [PK_cobrosManejo] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosManejoFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosManejoFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRegistroCobro] [int] NOT NULL,
	[idIngreso] [int] NOT NULL,
	[rubrosManejos] [float] NOT NULL,
 CONSTRAINT [PK_cobrosManejoFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosMarchElectro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosMarchElectro](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubrosMarchElect] [float] NOT NULL,
 CONSTRAINT [PK_cobrosMarchElectro] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosRevision]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosRevision](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroRevision] [float] NOT NULL,
 CONSTRAINT [PK_cobrosRevision] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosRevisionFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosRevisionFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroRevision] [float] NOT NULL,
 CONSTRAINT [PK_cobrosRevisionFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosRevisionIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosRevisionIng](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroRevision] [float] NOT NULL,
 CONSTRAINT [PK_cobrosRevisionIng] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosSeguroFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosSeguroFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRegistroCobro] [int] NOT NULL,
	[idIngreso] [int] NOT NULL,
	[rubrosSeguro] [float] NOT NULL,
 CONSTRAINT [PK_cobrosSeguroFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosZonaAduanera]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosZonaAduanera](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroZonaAduanera] [float] NOT NULL,
 CONSTRAINT [PK_cobrosZonaAduanera] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cobrosZonaAduaneraFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cobrosZonaAduaneraFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[rubroZonaAduanera] [float] NOT NULL,
 CONSTRAINT [PK_cobrosZonaAduaneraFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[codigosCif]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[codigosCif](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idNit] [int] NOT NULL,
	[codigo] [int] NOT NULL,
 CONSTRAINT [PK_codigosCif] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[consolidadoPoliza]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[consolidadoPoliza](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[codigoClan] [text] NOT NULL,
 CONSTRAINT [PK_consolidadoPoliza] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[contabilidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[contabilidad](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[idRetiro] [int] NOT NULL,
	[bultos] [int] NOT NULL,
	[tipoCambio] [float] NOT NULL,
	[valorTotalAduana] [float] NOT NULL,
	[totalValorCif] [float] NOT NULL,
	[valorImpuesto] [float] NOT NULL,
	[estadoSaldo] [int] NOT NULL,
	[fechaConta] [date] NOT NULL,
 CONSTRAINT [PK_CONTABLIDAD] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[correaltivoPoliza]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[correaltivoPoliza](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[numero] [int] NOT NULL,
	[fecha] [date] NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_correaltivoPoliza] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[correlativoFormas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[correlativoFormas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[correlativoFin] [int] NULL,
	[fechaInicio] [datetime] NULL,
 CONSTRAINT [PK_correlativoFormas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cuentasContables]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cuentasContables](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[cuenta] [text] NOT NULL,
	[nombreDeCuenta] [text] NOT NULL,
 CONSTRAINT [PK_cuentasContables] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[datosUnidades]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[datosUnidades](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idOp] [int] NOT NULL,
	[piloto] [int] NOT NULL,
	[unidadPlaca] [int] NOT NULL,
	[unidadContenedor] [int] NOT NULL,
	[marchamo] [text] NULL,
	[tipoOp] [int] NOT NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_DATOSUNIDADES] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[debeHaber]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[debeHaber](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[concepto] [text] NOT NULL,
 CONSTRAINT [PK_debeHaber] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[departamentos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[departamentos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[departamentos] [text] NOT NULL,
 CONSTRAINT [PK_departamentos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[descuentosCalculos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[descuentosCalculos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idCalculo] [int] NOT NULL,
	[descuento] [float] NOT NULL,
	[descuentoPercent] [float] NULL,
	[fechaRegistro] [datetime] NOT NULL,
	[estado] [int] NOT NULL,
	[tipoOp] [int] NULL,
 CONSTRAINT [PK_descuentosCalculos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DETALLE_RETIRO]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DETALLE_RETIRO](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[idIncidencia] [int] NOT NULL,
	[idRetiro] [int] NOT NULL,
	[bultos] [int] NULL,
	[posiciones] [int] NULL,
	[metros] [float] NULL,
	[fechaRetiro] [datetime] NULL,
 CONSTRAINT [PK_DETALLE_RETIRO] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detalleDeMercaderia]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detalleDeMercaderia](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[empresa] [text] NOT NULL,
	[bultos] [int] NOT NULL,
	[peso] [float] NOT NULL,
	[estado] [int] NULL,
	[fechaRealIng] [datetime] NULL,
	[stock] [int] NULL,
 CONSTRAINT [PK_DETALLEMERCADERIA] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DETALLESRECIBOS]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DETALLESRECIBOS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[numeroRecibo] [int] NULL,
	[estado] [int] NOT NULL,
	[emision] [datetime] NOT NULL,
	[fechaPago] [datetime] NULL,
 CONSTRAINT [PK_DETALLESRECIBOS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[empresas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[empresas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nit] [text] NULL,
	[empresa] [text] NULL,
	[establecimiento] [text] NULL,
	[direccion] [text] NULL,
	[telefono] [text] NULL,
	[email] [text] NULL,
	[logo] [text] NULL,
	[estado] [int] NULL,
	[fechaCreacion] [datetime] NULL,
 CONSTRAINT [PK_EMPRESAS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[empresasConsolidadas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[empresasConsolidadas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idNit] [int] NOT NULL,
	[consolidado] [text] NOT NULL,
	[estadoComision] [int] NOT NULL,
 CONSTRAINT [PK_empresasConsolidadas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ESTADOPOLIZAS]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ESTADOPOLIZAS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[idUserOpe] [int] NOT NULL,
	[operaciones] [int] NOT NULL,
	[fechaOpera] [datetime] NOT NULL,
	[idUserBod] [int] NULL,
	[descargadoUbicado] [int] NULL,
	[fechaDetalle] [datetime] NULL,
	[idUserOpeConta] [int] NULL,
	[reportadoConta] [int] NULL,
	[fechaReportado] [datetime] NULL,
 CONSTRAINT [PK_ESTADOPOLIZAS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[explicacionesContables]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[explicacionesContables](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[explicacion] [text] NOT NULL,
 CONSTRAINT [PK_explicacionesContables] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[gastos_Admin]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gastos_Admin](
	[idgastosAdmin] [int] IDENTITY(1,1) NOT NULL,
	[idTarifa] [int] NOT NULL,
	[idUsuarioCliente] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[basegastosAdmin] [text] NOT NULL,
	[monedaCalculo] [text] NOT NULL,
	[valorgastosAdmin] [float] NOT NULL,
	[aplicaServicio] [int] NOT NULL,
	[fechaCotizacion] [datetime] NOT NULL,
	[fechaInicio] [date] NOT NULL,
	[numeroSerie] [int] NOT NULL,
 CONSTRAINT [PK_GASTOS_ADMIN0] PRIMARY KEY CLUSTERED 
(
	[idgastosAdmin] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[grupoEmpresas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[grupoEmpresas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombreEmpresa] [text] NOT NULL,
 CONSTRAINT [PK_grupoEmpresas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[INACTIVOS]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[INACTIVOS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idMapeoBodega] [int] NOT NULL,
	[pasilloY] [int] NOT NULL,
	[columnaX] [int] NOT NULL,
 CONSTRAINT [PK_INACTIVOS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[incidencia]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[incidencia](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idDetalle] [int] NOT NULL,
	[idIngreso] [int] NOT NULL,
	[descripcionMercaderia] [text] NOT NULL,
	[posiciones] [int] NOT NULL,
	[metros] [float] NOT NULL,
	[estadoIncidencia] [int] NOT NULL,
	[stockPos] [int] NULL,
	[stockMts] [int] NULL,
	[fecha] [datetime] NULL,
	[idUsuario] [int] NULL,
 CONSTRAINT [PK_INCIDENCIA] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ingresoOperacionFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ingresoOperacionFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idCartaCupo] [text] NOT NULL,
	[numeroPoliza] [text] NOT NULL,
	[dua] [text] NOT NULL,
	[bl] [text] NOT NULL,
	[origenPuerto] [text] NOT NULL,
	[producto] [text] NOT NULL,
	[estadoIngreso] [int] NOT NULL,
	[fechaRegistro] [datetime] NOT NULL,
	[fechaContabilidad] [datetime] NULL,
	[idUsuarioCliente] [int] NOT NULL,
	[idNit] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[regimen] [int] NOT NULL,
	[familiaPoliza] [int] NULL,
	[consolidado] [int] NULL,
	[identBodega] [int] NULL,
 CONSTRAINT [PK_INGOPERACION] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ingresosConsolidadoPoliza]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ingresosConsolidadoPoliza](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[tipoOperacion] [int] NOT NULL,
	[idConsolidado] [int] NOT NULL,
	[cadenaVinculo] [text] NOT NULL,
	[estadoOperacion] [int] NOT NULL,
 CONSTRAINT [PK_ingresosConsolidadoPoliza] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inicioCorrelativos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inicioCorrelativos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[numeroInicio] [int] NOT NULL,
 CONSTRAINT [PK_inicioCorrelativos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[inventarioFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[inventarioFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[saldoBultos] [int] NOT NULL,
	[pesoKg] [float] NULL,
	[saldoValorTAduana] [float] NOT NULL,
	[saldoValorCif] [float] NOT NULL,
	[saldoValorImpuesto] [float] NOT NULL,
	[fechaReporte] [datetime] NULL,
	[tipo] [text] NULL,
 CONSTRAINT [PK_inventarioFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[manejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[manejo](
	[idManejo] [int] IDENTITY(1,1) NOT NULL,
	[idTarifa] [int] NOT NULL,
	[idUsuarioCliente] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[baseManejo] [text] NOT NULL,
	[monedaCalculo] [text] NOT NULL,
	[valorManejo] [float] NOT NULL,
	[aplicaServicio] [int] NOT NULL,
	[fechaCotizacion] [datetime] NOT NULL,
	[fechaInicio] [date] NOT NULL,
	[numeroSerie] [int] NOT NULL,
 CONSTRAINT [PK_MANEJO0] PRIMARY KEY CLUSTERED 
(
	[idManejo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[mapeoAreas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[mapeoAreas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idAreasAlmacenadoras] [int] NOT NULL,
	[pasY] [int] NOT NULL,
	[colX] [int] NOT NULL,
	[fechaCreacion] [datetime] NOT NULL,
 CONSTRAINT [PK_MAPEOAREAS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[medidasVehiculos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[medidasVehiculos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idTipoVeh] [int] NOT NULL,
	[linea] [text] NOT NULL,
	[largoMts] [float] NULL,
	[anchoMts] [float] NULL,
	[retrovisoresMts] [float] NULL,
	[espacioLateral] [float] NULL,
	[espacioFrontal] [float] NULL,
 CONSTRAINT [PK_medidasVehiculos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[metrajeDetallado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[metrajeDetallado](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIncidencia] [int] NULL,
	[idArea] [int] NULL,
	[pos] [int] NULL,
	[mts] [float] NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_metrajeDetallado] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[movimientosContaFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[movimientosContaFiscal](
	[id] [int] NOT NULL,
	[tipoMovimiento] [text] NOT NULL,
	[estado] [int] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[navegacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[navegacion](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idUsuario] [int] NOT NULL,
	[idArea] [int] NOT NULL,
	[fechaNavega] [datetime] NOT NULL,
 CONSTRAINT [PK_NAVEGACION] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[nit]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[nit](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nitEmpresa] [text] NOT NULL,
	[nombreEmpresa] [text] NOT NULL,
	[direccionEmpresa] [text] NOT NULL,
 CONSTRAINT [PK_NIT+] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[nivelesSistema]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[nivelesSistema](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nivelUsuario] [text] NOT NULL,
 CONSTRAINT [PK_nivelesSistema] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[nombresCorrelativos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[nombresCorrelativos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombreCorrelativo] [text] NOT NULL,
 CONSTRAINT [PK_nombresCorrelativos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[numAsignadoIngresos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[numAsignadoIngresos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIng] [int] NOT NULL,
	[idIdent] [int] NOT NULL,
	[numeroAsignado] [int] NOT NULL,
	[fechaContabilizado] [datetime] NOT NULL,
 CONSTRAINT [PK_numAsignadoIngresos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[numAsignadoPaseVacio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[numAsignadoPaseVacio](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idUnidad] [int] NOT NULL,
	[idIdent] [int] NOT NULL,
	[numeroAsignado] [int] NOT NULL,
	[fechaContabilizado] [datetime] NOT NULL,
 CONSTRAINT [PK_numAsignadoPaseVacio] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[numAsignadoRecibos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[numAsignadoRecibos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRet] [int] NOT NULL,
	[idIng] [int] NOT NULL,
	[idIdent] [int] NOT NULL,
	[numeroAsignado] [int] NOT NULL,
	[fechaAsignado] [datetime] NOT NULL,
	[idFact] [int] NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_numAsignadoRecibos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[numAsignadoRetiros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[numAsignadoRetiros](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRet] [int] NOT NULL,
	[idIng] [int] NOT NULL,
	[idIdent] [int] NOT NULL,
	[numeroAsignado] [int] NOT NULL,
	[fechaAsignado] [datetime] NOT NULL,
 CONSTRAINT [PK_numAsignadoRetiros] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[numeradorCorrelativos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[numeradorCorrelativos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idCategoria] [int] NOT NULL,
	[idnomCorrelativo] [int] NOT NULL,
	[ultimoNumero] [int] NOT NULL,
 CONSTRAINT [PK_numeradorCorrelativos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[numPolizaFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[numPolizaFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[ultimoNumero] [int] NOT NULL,
 CONSTRAINT [PK_numPolizaFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[OC]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[OC](
	[NUMERO] [int] NULL,
	[FECHA] [datetime] NULL,
	[CLIENTE] [varchar](50) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[operacionesEnSistema]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[operacionesEnSistema](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[operacion] [text] NULL,
	[tipo] [text] NOT NULL,
 CONSTRAINT [PK_operacionesEnSistema] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[OTROS_GASTOS]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[OTROS_GASTOS](
	[idotrosGastos] [int] IDENTITY(1,1) NOT NULL,
	[idTarifa] [int] NOT NULL,
	[idUsuarioCliente] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[baseotrosGastos] [text] NOT NULL,
	[monedaCalculo] [text] NOT NULL,
	[valorotrosGastos] [float] NOT NULL,
	[aplicaServicio] [int] NOT NULL,
	[fechaCotizacion] [datetime] NOT NULL,
	[fechaInicio] [date] NOT NULL,
	[numeroSerie] [int] NOT NULL,
 CONSTRAINT [PK_OTROS_GASTOS0] PRIMARY KEY CLUSTERED 
(
	[idotrosGastos] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[otrosServicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[otrosServicios](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[otrosServicios] [text] NOT NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_otrosServicioss] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[otrosServiciosDescuentos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[otrosServiciosDescuentos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRet] [int] NOT NULL,
	[idOperacion] [int] NOT NULL,
	[tipoOp] [int] NOT NULL,
	[fechaEmision] [datetime] NOT NULL,
 CONSTRAINT [PK_otrosServiciosDescuentos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[parametros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[parametros](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[codigo] [int] NOT NULL,
	[numeroParametro] [int] NOT NULL,
	[nombreParametro] [text] NOT NULL,
 CONSTRAINT [PK_PARAMETROS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pasesDeSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pasesDeSalida](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idUnidad] [int] NOT NULL,
 CONSTRAINT [PK_pasesDeSalidaTokens] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[personal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[personal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombres] [text] NOT NULL,
	[apellidos] [text] NOT NULL,
	[usuarios] [int] NOT NULL,
	[contra] [text] NOT NULL,
	[dpi] [text] NOT NULL,
	[nivel] [int] NOT NULL,
	[departamento] [int] NOT NULL,
	[dependencia] [int] NOT NULL,
	[telefono] [int] NOT NULL,
	[email] [text] NOT NULL,
	[emailEncriptado] [text] NOT NULL,
	[foto] [text] NULL,
	[estado] [int] NOT NULL,
	[ultimo_login] [datetime] NULL,
	[fecha_creacion] [datetime] NOT NULL,
	[intentos] [int] NOT NULL,
	[preguntaSecreta] [text] NOT NULL,
	[respuesta] [text] NOT NULL,
 CONSTRAINT [PK_personal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[personalVisitas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[personalVisitas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[licDoc] [text] NOT NULL,
	[nombreApellido] [text] NOT NULL,
 CONSTRAINT [PK_personalVisitas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pilotos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pilotos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[licencia] [text] NOT NULL,
	[piloto] [text] NOT NULL,
 CONSTRAINT [PK_PILOTO] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[placasVisita]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[placasVisita](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[placa] [text] NULL,
 CONSTRAINT [PK_placasVisita] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[polizasContaFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[polizasContaFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idCuenta] [int] NULL,
	[idEmpresa] [int] NULL,
	[monto] [float] NULL,
	[estado] [int] NULL,
	[idExplicacion] [int] NULL,
	[numeroPoliza] [int] NULL,
	[idDebeHaber] [int] NULL,
 CONSTRAINT [PK_polizasContaFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[POSINACTIVAS]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[POSINACTIVAS](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[pasillo] [int] NOT NULL,
	[columna] [int] NOT NULL,
 CONSTRAINT [PK_POSINACTIVAS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[posMetrajeBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[posMetrajeBod](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIncidencia] [int] NOT NULL,
	[idAreaBod] [int] NOT NULL,
	[posiciones] [int] NOT NULL,
	[metraje] [float] NOT NULL,
	[promedio] [float] NOT NULL,
	[stockPos] [int] NULL,
	[stockMetraje] [float] NULL,
 CONSTRAINT [PK_posMetrajeBod] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[prediosDeVehiculos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[prediosDeVehiculos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[predio] [text] NOT NULL,
	[descripcion] [text] NOT NULL,
	[idDependencia] [int] NULL,
 CONSTRAINT [PK_prediosDeVehiculos] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[procedenciaVisita]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[procedenciaVisita](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[empresa] [text] NULL,
 CONSTRAINT [PK_procedenciaVisita] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[regimen]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[regimen](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[regimen] [text] NOT NULL,
	[familia] [int] NOT NULL,
 CONSTRAINT [PK_REGIMEN] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[registroDeCobros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[registroDeCobros](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRetiro] [int] NOT NULL,
	[fechaIngreso] [date] NOT NULL,
	[fechaRetiro] [date] NOT NULL,
	[estado] [int] NULL,
	[fechaRegistro] [datetime] NULL,
 CONSTRAINT [PK_registroDeCobros] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[registroDeCobrosFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[registroDeCobrosFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[fechaIngreso] [date] NOT NULL,
	[fechaRetiro] [date] NOT NULL,
	[estado] [int] NULL,
	[fechaRegistro] [datetime] NULL,
 CONSTRAINT [PK_registroDeCobrosFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[retiroOperacionFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[retiroOperacionFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngresosOP] [int] NOT NULL,
	[idNit] [int] NOT NULL,
	[polizaRetiro] [text] NOT NULL,
	[regimenSalida] [text] NOT NULL,
	[descripcion] [text] NOT NULL,
	[idUsuario] [int] NOT NULL,
	[idDependencia] [int] NOT NULL,
	[estadoRet] [int] NOT NULL,
	[detallesRebajados] [text] NULL,
	[fechaEmision] [datetime] NULL,
	[fechaRetiro] [datetime] NULL,
	[fechaConta] [datetime] NULL,
 CONSTRAINT [PK_retiroOperacionFiscal] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[retiroOperacionFVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[retiroOperacionFVeh](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngresosOP] [int] NOT NULL,
	[idNit] [int] NOT NULL,
	[polizaRetiro] [text] NOT NULL,
	[regimenSalida] [text] NOT NULL,
	[descripcion] [text] NOT NULL,
	[idUsuario] [int] NOT NULL,
	[idDependencia] [int] NOT NULL,
	[estadoRet] [int] NOT NULL,
	[fechaEmision] [datetime] NULL,
	[fechaRetiro] [datetime] NULL,
	[fechaConta] [date] NULL,
 CONSTRAINT [PK_retiroOperacionFVeh] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[saldoContable801109_01]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[saldoContable801109_01](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idEmpresa] [int] NOT NULL,
	[idPoliza] [int] NOT NULL,
	[numeroPoliza] [int] NOT NULL,
	[tipoTransaccion] [text] NOT NULL,
	[operacion] [text] NOT NULL,
	[monto] [float] NOT NULL,
	[saldo] [float] NOT NULL,
 CONSTRAINT [PK_saldoContable801109_01] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[saldoContable801109_01AF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[saldoContable801109_01AF](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idEmpresa] [int] NOT NULL,
	[idPoliza] [int] NOT NULL,
	[numeroPoliza] [int] NOT NULL,
	[tipoTransaccion] [text] NOT NULL,
	[operacion] [text] NOT NULL,
	[monto] [float] NOT NULL,
	[saldo] [float] NOT NULL,
 CONSTRAINT [PK_saldoContable801109_01AF] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[saldoContable802103_0101AF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[saldoContable802103_0101AF](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idEmpresa] [int] NOT NULL,
	[idPoliza] [int] NOT NULL,
	[numeroPoliza] [int] NOT NULL,
	[tipoTransaccion] [text] NOT NULL,
	[operacion] [text] NOT NULL,
	[monto] [float] NOT NULL,
	[saldo] [float] NOT NULL,
 CONSTRAINT [PK_saldoContable802103_0101AF] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[saldoContable802103_0102]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[saldoContable802103_0102](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idEmpresa] [int] NOT NULL,
	[idPoliza] [int] NOT NULL,
	[numeroPoliza] [int] NOT NULL,
	[tipoTransaccion] [text] NOT NULL,
	[operacion] [text] NOT NULL,
	[monto] [float] NOT NULL,
	[saldo] [float] NOT NULL,
 CONSTRAINT [PK_saldos802103_0102] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[seguro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[seguro](
	[idSeguro] [int] IDENTITY(1,1) NOT NULL,
	[idTarifa] [int] NOT NULL,
	[idUsuarioCliente] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[periodSeguro] [text] NOT NULL,
	[baseSeguro] [text] NOT NULL,
	[periodoCalculo] [text] NOT NULL,
	[monedaCalculo] [text] NOT NULL,
	[valorSeguro] [float] NOT NULL,
	[aplicaServicio] [int] NOT NULL,
	[fechaCotizacion] [datetime] NOT NULL,
	[fechaInicio] [date] NOT NULL,
	[numeroSerie] [int] NOT NULL,
 CONSTRAINT [PK_SEGURO0] PRIMARY KEY CLUSTERED 
(
	[idSeguro] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[servicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[servicios](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[codigoServicio] [text] NOT NULL,
	[tipoDeServicio] [text] NOT NULL,
	[servicio] [text] NOT NULL,
	[tipoAlmacenaje] [text] NOT NULL,
 CONSTRAINT [PK_SERVICIO] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[serviciosDefault]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[serviciosDefault](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[servicioDefault] [text] NOT NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_serviciosDefault] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[serviciosDefExtras]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[serviciosDefExtras](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idTipoTran] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[montoExtra] [float] NOT NULL,
	[fechaRegistro] [datetime] NOT NULL,
	[comentarios] [text] NOT NULL,
	[usuario] [int] NOT NULL,
	[estado] [int] NOT NULL,
	[tipoTran] [int] NOT NULL,
 CONSTRAINT [PK_serviciosDefExtras] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[serviciosExtrasPrestados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[serviciosExtrasPrestados](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idCalculo] [int] NOT NULL,
	[idServicio] [int] NOT NULL,
	[montoServicio] [float] NOT NULL,
	[fechaRegistro] [datetime] NOT NULL,
	[estado] [int] NOT NULL,
	[tipo] [int] NULL,
 CONSTRAINT [PK_serviciosExtrasPrestados] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[sinCodigo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[sinCodigo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idNit] [int] NOT NULL,
	[idEmisor] [int] NOT NULL,
	[idReceptor] [int] NOT NULL,
	[ComentariosEmisor] [text] NOT NULL,
	[ComentariosReceptor] [text] NOT NULL,
	[fechaInicio] [datetime] NOT NULL,
	[FechaFin] [datetime] NOT NULL,
	[estado] [nchar](10) NOT NULL,
 CONSTRAINT [PK_sinCodigo] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[subBitacoraCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[subBitacoraCalc](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idBitacora] [int] NOT NULL,
	[fechaCalc] [date] NOT NULL,
 CONSTRAINT [PK_subBitacoraCalc] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tarifasNormales]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tarifasNormales](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[Dependencia_Nit] [text] NOT NULL,
	[Regimen_Nit] [text] NOT NULL,
	[Tipo_Direccion] [text] NOT NULL,
	[baseAlmacenaje] [text] NOT NULL,
	[PeriodoAlmacenaje] [text] NOT NULL,
	[tarifaAlmacenaje] [float] NOT NULL,
	[minimoAlmacenaje] [float] NOT NULL,
	[delAlmacenaje] [int] NOT NULL,
	[alAlmacenaje] [int] NOT NULL,
	[baseZonaAduanera] [text] NOT NULL,
	[PeriodoZonaAduanera] [text] NOT NULL,
	[tarifaZonaAduanera] [float] NOT NULL,
	[minimoZonaAduanera] [float] NOT NULL,
	[delZA] [int] NOT NULL,
	[baseManejo] [text] NOT NULL,
	[tarifaManejo] [float] NOT NULL,
	[minimoManejo] [float] NULL,
	[baseGastosAdmin] [text] NOT NULL,
	[tarifaGastosAdministrativos] [float] NOT NULL,
	[minGastosAdministracion] [float] NOT NULL,
	[baseGastosFotocopias] [text] NOT NULL,
	[tarifaFotocopias] [float] NOT NULL,
	[baseCalculoDescargaRevision] [text] NOT NULL,
	[calculoDescargaRevision] [float] NOT NULL,
	[baseCalculoOtrosGastos] [text] NOT NULL,
	[calculoOtrosGastos] [float] NOT NULL,
	[fechaTarifa] [date] NOT NULL,
	[fechaVigencia] [date] NOT NULL,
	[fechaVencimiento] [date] NOT NULL,
	[marchamoElectronico] [float] NULL,
	[aplicaMarchamoElec] [int] NULL,
	[minimoMarch] [float] NULL,
	[reglaAproximacion] [int] NULL,
	[apartirFecha] [date] NULL,
 CONSTRAINT [PK_tarifasNormales] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tarifasVehUsados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tarifasVehUsados](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idNit] [int] NOT NULL,
	[servicio] [text] NOT NULL,
	[tipoMinimo] [text] NOT NULL,
	[minimoCobro] [float] NOT NULL,
	[diaDeta] [int] NOT NULL,
	[deltaAlmacenajeDiario] [float] NOT NULL,
	[ultimaTarifa] [datetime] NOT NULL,
	[marchamoElectronico] [float] NULL,
	[aplicaMarchamoElec] [int] NULL,
	[minimoMarch] [float] NULL,
	[apartirFecha] [date] NULL,
 CONSTRAINT [PK_tarifasVehUsados] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbPrueba]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbPrueba](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idPrueba] [int] NOT NULL,
 CONSTRAINT [PK_tbPrueba] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tipoCambio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tipoCambio](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tipoCambio] [float] NOT NULL,
	[fechaCambio] [date] NOT NULL,
 CONSTRAINT [PK_tipoCambio] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tiposDeVehiculos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tiposDeVehiculos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tipoVehiculo] [text] NOT NULL,
 CONSTRAINT [PK_tiposDeVehiculo] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tipoTransacciones]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tipoTransacciones](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[transaccionIng] [text] NOT NULL,
	[estado] [int] NOT NULL,
 CONSTRAINT [PK_tipoTransacciones] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tokensSalidas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tokensSalidas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idPase] [int] NOT NULL,
	[token] [text] NOT NULL,
	[fechaCreacion] [datetime] NOT NULL,
 CONSTRAINT [PK_tokensSalidas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[trasladoFiscalVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[trasladoFiscalVeh](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idRet] [int] NOT NULL,
	[chasis] [int] NOT NULL,
	[cantidad] [int] NOT NULL,
	[cif] [float] NULL,
	[impuesto] [float] NULL,
	[valUnitario] [float] NOT NULL,
	[fechaEmision] [datetime] NOT NULL,
	[fechaCorreo] [datetime] NULL,
	[fechaSalida] [datetime] NULL,
	[fechaContabilidad] [datetime] NULL,
	[idUsuario] [int] NOT NULL,
	[estado] [int] NOT NULL,
 CONSTRAINT [PK_trasladoFiscalVeh] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ubicaciones]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ubicaciones](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIncidencia] [int] NOT NULL,
	[pasY] [int] NOT NULL,
	[ColX] [int] NOT NULL,
	[idAreaBodega] [int] NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_UBICACIONES] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[unidadesContenedores]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[unidadesContenedores](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[contenedor] [text] NOT NULL,
 CONSTRAINT [PK_unidadesContenedores] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[unidadesPlacas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[unidadesPlacas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[placa] [text] NOT NULL,
 CONSTRAINT [PK_UNIDADES] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[usuariosExternos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[usuariosExternos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nombres] [text] NOT NULL,
	[apellidos] [text] NOT NULL,
	[usuarios] [int] NOT NULL,
	[contra] [text] NOT NULL,
	[dpi] [text] NOT NULL,
	[telefono] [int] NOT NULL,
	[email] [text] NOT NULL,
	[emailEncriptado] [text] NOT NULL,
	[preguntaSecreta] [text] NOT NULL,
	[respuesta] [text] NOT NULL,
	[razonSocial] [text] NOT NULL,
	[nombreComercial] [text] NOT NULL,
	[direccionFiscal] [text] NOT NULL,
	[direccionDeRecibos] [text] NOT NULL,
	[nit] [text] NOT NULL,
	[contacto] [text] NOT NULL,
	[foto] [text] NULL,
	[estado] [int] NOT NULL,
	[ultimo_login] [datetime] NULL,
	[fecha_creacion] [datetime] NOT NULL,
	[estadoTarifa] [int] NOT NULL,
	[ejecutivoVentas] [int] NOT NULL,
	[intentos] [int] NOT NULL,
	[numeroTarifa] [int] NULL,
	[idNit] [int] NOT NULL,
 CONSTRAINT [PK_USUARIOSEXTERNOS] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[valoresFob]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[valoresFob](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[valorFob] [float] NOT NULL,
 CONSTRAINT [PK_valoresFob] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[valoresIngOpFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[valoresIngOpFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[cantidadContenedores] [int] NOT NULL,
	[cantidadClientes] [int] NOT NULL,
	[peso] [float] NOT NULL,
	[bultos] [int] NOT NULL,
	[valorTotalAduana] [float] NOT NULL,
	[tipoCambio] [float] NOT NULL,
	[totalValorCif] [float] NOT NULL,
	[valorImpuesto] [float] NOT NULL,
	[estadoSaldo] [int] NOT NULL,
	[fechaRealIng] [datetime] NOT NULL,
 CONSTRAINT [PK_SALDOS_FISCAL] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[valoresPolizaDR]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[valoresPolizaDR](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIng] [int] NOT NULL,
	[idRet] [int] NOT NULL,
	[bultos] [int] NOT NULL,
	[valDolares] [float] NOT NULL,
	[cif] [float] NOT NULL,
	[impuesto] [float] NOT NULL,
 CONSTRAINT [PK_valoresPolizaDR] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[valoresRetirosFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[valoresRetirosFiscal](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[idRet] [int] NOT NULL,
	[bultos] [int] NOT NULL,
	[peso] [float] NOT NULL,
	[tipoCambio] [float] NOT NULL,
	[valorTotalAduana] [float] NOT NULL,
	[totalValorCif] [float] NOT NULL,
	[valorImpuesto] [float] NOT NULL,
	[estadoSaldo] [int] NOT NULL,
 CONSTRAINT [PK_SALDOS_FISCALRET] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[vehiculosUsados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[vehiculosUsados](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idIngreso] [int] NOT NULL,
	[idDetalle] [int] NOT NULL,
	[tipoVehiculo] [text] NOT NULL,
	[marcaVehiculo] [text] NOT NULL,
	[lineaVehiculo] [text] NOT NULL,
	[modeloVehiculo] [text] NOT NULL,
	[ubicacionPredio] [int] NULL,
 CONSTRAINT [PK_vehiculosUsados] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[vinculosDeBodegas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[vinculosDeBodegas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idArea] [int] NOT NULL,
	[idBodega] [int] NOT NULL,
 CONSTRAINT [PK_vinculosDeBodegas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
UNIQUE NONCLUSTERED 
(
	[idBodega] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[visitasAlmacenadoraIntegrada]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[visitasAlmacenadoraIntegrada](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[idPiloto] [int] NOT NULL,
	[idPlaca] [int] NOT NULL,
	[idAreaVisita] [int] NOT NULL,
	[idEmpresaVisita] [int] NOT NULL,
	[NoGafete] [int] NOT NULL,
	[fechaIngreso] [datetime] NOT NULL,
	[fechaSalida] [datetime] NULL,
	[estado] [int] NOT NULL,
	[usuario] [int] NULL,
	[empresa] [int] NULL,
 CONSTRAINT [PK_visitasAlmacenadoraIntegrada] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  StoredProcedure [dbo].[ActualizarDetInv]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[ActualizarDetInv]
@idDetalle INT,
@bultosReb INT
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranActDetInv

DECLARE @stock INT
SET @stock = (SELECT stock FROM detalleDeMercaderia WHERE id = @idDetalle)

DECLARE @NewSaldo INT
SET @NewSaldo = (@stock-@bultosReb)
IF (@NewSaldo>=0)
BEGIN
UPDATE detalleDeMercaderia SET stock = @NewSaldo WHERE id = @idDetalle
END

SET @error = @@ERROR

IF	(@error!=0)
BEGIN
ROLLBACK TRAN tranActDetInv
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranActDetInv
SELECT 1 'resp'
END


END
GO
/****** Object:  StoredProcedure [dbo].[AnulacionDef]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[AnulacionDef]
@idIngreso int

AS
BEGIN
	SET NOCOUNT ON;

UPDATE ingresoOperacionFiscal 
SET estadoIngreso = -1
WHERE id = @idIngreso

END
GO
/****** Object:  StoredProcedure [dbo].[InicioDetallesAjustes]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[InicioDetallesAjustes]
@idBodega INT
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranInicioInv


DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)


UPDATE detalleDeMercaderia SET stock = bultos

FROM detalleDeMercaderia det
INNER JOIN ingresoOperacionFiscal ing ON ing.id = det.idIngreso
INNER JOIN bodegas bod on bod.id = ing.identBodega and bod.dependencia = @dependencia
left JOIN chasisVehiculosNuevos chas ON chas.idIngreso = ing.id 
where chas.id is null



SET @error = @@ERROR

IF	(@error!=0)
BEGIN
ROLLBACK TRAN tranInicioInv
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranInicioInv
SELECT 1 'resp'
END


END
GO
/****** Object:  StoredProcedure [dbo].[spActCobro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spActCobro]

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @peso float
DECLARE @bultos int
DECLARE @aduanaDolar float
DECLARE @cif float
DECLARE @impuestos float
DECLARE @ingPeso float
DECLARE @ingBultos int
DECLARE @ingAduanaDolar float
DECLARE @ingCif float
DECLARE @ingImpuestos float
DECLARE @idIng int
	 
SET @bultos = (SELECT SUM(bultos) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = 1 AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),GETDATE(),105))
SET @peso = (SELECT SUM(peso) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = 1 AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),GETDATE(),105))
SET @aduanaDolar = (SELECT SUM(valorTotalAduana) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = 1 AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),GETDATE(),105))
SET @cif = (SELECT SUM(totalValorCif) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = 1 AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),GETDATE(),105))
SET @impuestos = (SELECT SUM(valorImpuesto) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = 1 AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),GETDATE(),105))

SET @idIng = (SELECT TOP(1) sldf.idIngreso FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = 1 ORDER BY sldf.id)
SET @ingPeso = (SELECT SUM(sldf.peso)-@peso AS 'saldoPeso' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = 1)
SET @ingBultos = (SELECT SUM(sldf.bultos)-@bultos AS 'saldosBultos' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = 1)
SET @ingAduanaDolar = (SELECT SUM(sldf.valorTotalAduana)-@aduanaDolar AS 'saldoAduana' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = 1)
SET @ingCif = (SELECT SUM(sldf.totalValorCif)-@cif AS 'saldoCif' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = 1)
SET @ingImpuestos = (SELECT SUM(sldf.valorImpuesto)-@impuestos AS 'saldoImpuesto' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = 1)

DECLARE @idSaldoCobro int
SET @idSaldoCobro = (SELECT TOP (1) sldC.id FROM SALDOS_COBRO sldC WHERE sldC.idIngreso = 3 AND sldC.estadoSaldo = 1 ORDER BY sldC.estadoSaldo DESC)  
UPDATE SALDOS_COBRO 
SET estadoSaldo = 2
WHERE id = @idSaldoCobro
INSERT INTO [dbo].[SALDOS_COBRO] 
([idIngreso], [cantidadContenedores], [cantidadClientes], [peso], [bultos], [valorTotalAduana], [tipoCambio], [totalValorCif],[valorImpuesto],[totalPosiciones], [totalMetros], [estadoSaldo], [tipoOperacion], [idRetiros],[fechaRealIng])
VALUES 
(@idIng, 0, 0, @ingPeso, @ingBultos, @ingAduanaDolar, 0, @ingCif,@ingImpuestos, 0, 0, 1, 2, '0', GETDATE())



END
GO
/****** Object:  StoredProcedure [dbo].[spActivacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spActivacion]
	@estadoTarifa int,
	@idCliente int,
	@numeroTarifa int
AS
BEGIN
	SET NOCOUNT ON;

UPDATE USUARIOSEXTERNOS
SET estadoTarifa=@estadoTarifa
WHERE id=@idCliente
AND numeroTarifa=@numeroTarifa

END
GO
/****** Object:  StoredProcedure [dbo].[spActivacion1]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spActivacion1]
	@estadoTarifa int,
	@idCliente int
	AS
BEGIN
	SET NOCOUNT ON;


UPDATE USUARIOSEXTERNOS
SET estadoTarifa=@estadoTarifa
WHERE id=@idCliente


END


GO
/****** Object:  StoredProcedure [dbo].[spActivarTarifa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spActivarTarifa]
	@valor int,
	@idUser int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN
	UPDATE usuariosExternos
	SET estadoTarifa = @valor
	WHERE id = @idUser
	
SET @error = @@Error
	IF (@error<>0)
	BEGIN
		ROLLBACK
		SELECT 0 AS 'resp'
		END
	ELSE
	BEGIN
		COMMIT
		SELECT 1 AS 'resp'
	END
END

GO
/****** Object:  StoredProcedure [dbo].[spActualizarStock]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spActualizarStock]

	@idCliente int,
	@pos int,
	@mts float
	

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @saldoStockPos int
SET @saldoStockPos = (SELECT stockPos FROM incidencia WHERE idDetalle = @idCliente)

DECLARE @saldoStockMts int
SET @saldoStockMts = (SELECT stockMts FROM incidencia WHERE idDetalle = @idCliente)

DECLARE @nuevoStockPos int
SET @nuevoStockPos = @saldoStockPos-@pos

DECLARE @nuevoStockMts float
SET @nuevoStockMts = @saldoStockMts-@mts

UPDATE incidencia
set stockPos = @nuevoStockPos, stockMts = @nuevoStockMts
WHERE idDetalle = @idCliente
END
GO
/****** Object:  StoredProcedure [dbo].[spActualizarStockPOSM]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spActualizarStockPOSM]

	@idCliente int,
	@idPos int,
	@pos int,
	@mts float
	

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @saldoStockPos int
SET @saldoStockPos = (SELECT stockPos FROM posMetrajeBod WHERE id = @idPos)

DECLARE @saldoStockMts int
SET @saldoStockMts = (SELECT stockMetraje FROM posMetrajeBod WHERE id = @idPos)



DECLARE @nuevoStockPos int
SET @nuevoStockPos = @saldoStockPos-@pos

DECLARE @nuevoStockMts float
SET @nuevoStockMts = @saldoStockMts-@mts
select @nuevoStockPos, @nuevoStockMts

IF	(@nuevoStockPos>=0 AND @nuevoStockPos>=0)
BEGIN
DECLARE @error int
BEGIN TRAN tranUpdatePos
UPDATE posMetrajeBod
set stockPos = @nuevoStockPos, stockMetraje = @nuevoStockMts
WHERE id = @idPos 

SET @error = @@ERROR

IF (@error !=0 )
BEGIN
ROLLBACK TRAN tranUpdatePos
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranUpdatePos
SELECT 1 'resp'
END
END
ELSE
BEGIN
SELECT 2 'resp'
END
END

GO
/****** Object:  StoredProcedure [dbo].[spAjustesContables]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spAjustesContables]
	@ident int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @ident)

SELECT 
ing.id, ing.numeroPoliza,
inv.saldoValorCif, inv.saldoValorImpuesto

FROM  ingresoOperacionFiscal ing
inner join retiroOperacionFiscal ret on ret.idIngresosOP = ing.id 
inner join inventarioFiscal inv ON inv.idIngreso = ing.id
INNER JOIN bodegas ON bodegas.dependencia = @dependencia and ing.identBodega = bodegas.id
and inv.saldoBultos = 0 
where ret.estadoRet = 5 and ing.estadoIngreso >= 5 and inv.tipo is null			


END


GO
/****** Object:  StoredProcedure [dbo].[spAjustesVehiculosNew]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spAjustesVehiculosNew]

@idBodega int

	AS
BEGIN
	SET NOCOUNT ON;

/**
**


EN ESTE QUERY SE DETALLA UNA CONSULTA DE AJUSTES DE VEHICULOS NUEVOS, 

SE HACE UNA CONSULTA PARA SABER QUE DA'S DE LOS DISTINTOS VEHICULOS CONTABILIDAZADOS SE PUEDEN CONTABILIZAR

SABIENDO ESTO ENVIAMOS UN LOTE DE ROWS AL MODELO PARA SU EVALUACION, PARA QUE NO EXISTAN AJUSTES DUPLICADOS



**
**/
DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)


	DECLARE @inicio INT
	SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)

	SELECT  
	ing.numeroPoliza, ing.id,
	ROUND(inv.saldoValorCif,2) AS 'cif', ROUND(inv.saldoValorImpuesto, 2) as 'impuesto', @dependencia as 'dependencia'
	FROM trasladoFiscalVeh tras
	left join retiroOperacionFiscal ret ON ret.id = tras.idRet
	left join chasisVehiculosNuevos chas ON chas.id = tras.chasis
	left join medidasVehiculos med ON med.id = chas.lineaVehiculo
	left join tiposDeVehiculos tip on tip.id  = chas.tipoVehiculo
	left join ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP 
	AND
	(SELECT
	 COUNT(*)
	from trasladoFiscalVeh trasSe
	inner join retiroOperacionFiscal ret on ret.id = trasSe.idRet 
	inner join inventarioFiscal inv on inv.idIngreso = ret.idIngresosOP AND ret.idIngresosOP = ing.id and trasSe.estado = 2
	inner join valoresIngOpFiscal valIng on valIng.idIngreso = ret.idIngresosOP
	where inv.saldoBultos = 0 and 
	(inv.saldoBultos = 0 and inv.saldoValorCif !=0) or (inv.saldoBultos = 0 and inv.saldoValorImpuesto!=0))
	= (SELECT
	(sum(valIng.bultos) / COUNT(*))
	from trasladoFiscalVeh trasSe
	inner join retiroOperacionFiscal ret on ret.id = trasSe.idRet 
	inner join inventarioFiscal inv on inv.idIngreso = ret.idIngresosOP AND ret.idIngresosOP = ing.id
	inner join valoresIngOpFiscal valIng on valIng.idIngreso = ret.idIngresosOP
	where inv.saldoBultos = 0 and 
	(inv.saldoBultos = 0 and inv.saldoValorCif !=0) or (inv.saldoBultos = 0 and inv.saldoValorImpuesto!=0))
	inner join inventarioFiscal inv on inv.idIngreso = ret.idIngresosOP
	and  ing.id IS NOT NULL 
	left join numAsignadoIngresos ingAsig ON ingAsig.idIng = ret.idIngresosOP
	left join numAsignadoRetiros retAs ON retAs.idRet = ret.id
	left join valoresIngOpFiscal val ON val.idIngreso = ret.idIngresosOP 
	LEFT JOIN bodegas ON bodegas.id = ing.identBodega and bodegas.dependencia = @dependencia
	left join agrupacionEmpresas agpr on agpr.idNitVeh = ret.idNit
	left join grupoEmpresas gpr on gpr.id = agpr.idEmpGp
	left join nit on nit.id = ing.idNit
	left join nit nitRet on nitRet.id = ret.idNit
	where tras.estado = 2  
	AND (inv.saldoBultos = 0 and inv.saldoValorCif !=0) or (inv.saldoBultos = 0 and inv.saldoValorImpuesto!=0)




END


GO
/****** Object:  StoredProcedure [dbo].[spAnulacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spAnulacion]
	@ret int,
	@idUser int,
	@motivo text, 
	@tipo int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranAnulacion
DECLARE @inicio int
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)
IF (@tipo=0)
BEGIN


DECLARE @numAsig int
SET @numAsig = (select numeroAsignado from numAsignadoRecibos where idRet = @ret)

DECLARE @numero int
SET @numero = @numAsig+@inicio

DECLARE @comentario VARCHAR(50)
SET @comentario = CONCAT('AnulaciÃ³n Recibo', ' ', @numero, ' : ', @motivo)

UPDATE numAsignadoRecibos 
SET estado = 0
WHERE idRet = @ret

UPDATE retiroOperacionFiscal 
SET estadoRet = 3
WHERE id = @ret

DECLARE @time datetime
SET @time = GETDATE()

EXECUTE spBitacoraRet @ret, @comentario, @idUser, 0, @time
END
IF (@tipo=1)
BEGIN

DECLARE @numAsigRet int
SET @numAsigRet = (select numeroAsignado from numAsignadoRetiros where idRet = @ret)

DECLARE @numeroRet int
SET @numeroRet = @numAsigRet+@inicio

DECLARE @comentarioRet VARCHAR(50)
SET @comentarioRet = CONCAT('AnulaciÃ³n Retiro', ' ', @numero, ' : ', @motivo)

UPDATE retiroOperacionFiscal 
SET estadoRet = 0
WHERE id = @ret

DECLARE @timeRet datetime
SET @timeRet = GETDATE()

EXECUTE spBitacoraRet @ret, @comentarioRet, @idUser, 0, @timeRet
END


SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranAnulacion
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranAnulacion
SELECT 1 'resp'
END



END


GO
/****** Object:  StoredProcedure [dbo].[spAnularDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spAnularDet]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;
   
 delete detalleDeMercaderia
 WHERE id=@valor



END


GO
/****** Object:  StoredProcedure [dbo].[spAnularIncid]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spAnularIncid]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

UPDATE incidencia
SET estadoIncidencia=2
WHERE idDetalle=@valor

UPDATE detalleDeMercaderia
SET estado=0
WHERE id=@valor
END


GO
/****** Object:  StoredProcedure [dbo].[spAnularOPF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spAnularOPF]
	@id int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE INGOPERACIONES
SET estadoIngreso=0
WHERE id=@id
END


GO
/****** Object:  StoredProcedure [dbo].[spAnularRetiro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spAnularRetiro]
@idRet int,
@text text,
@idUsuario int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranSQLAnular
DECLARE @idIng INT
SET @idIng = (SELECT idIngresosOP FROM retiroOperacionFiscal WHERE id = @idRet)
UPDATE retiroOperacionFiscal SET polizaRetiro = CONCAT(polizaRetiro, 'ANL'), estadoRet = -1 WHERE id = @idRet
UPDATE valoresRetirosFiscal SET estadoSaldo = -1 WHERE idRet = @idRet

UPDATE chasisVehiculosNuevos SET idRet = NULL, estado = 1 WHERE idRet = @idRet

UPDATE trasladoFiscalVeh SET estado = 0 WHERE idRet = @idRet

DECLARE @date DATETIME
SET @date = GETDATE()
EXECUTE spBitacoraRet @idRet, @text, @idUsuario, 1, @date

SET @error = @@ERROR

IF (@error!=0)
BEGIN 
ROLLBACK TRAN tranSQLAnular
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranSQLAnular
SELECT 1 'resp'
EXECUTE spStockGeneral @idIng
END


END
GO
/****** Object:  StoredProcedure [dbo].[spAnularTarifa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spAnularTarifa]
	@id int,
	@numeroTarifa int

AS
BEGIN
	SET NOCOUNT ON;

UPDATE USUARIOSEXTERNOS
SET estadoTarifa=0, numeroTarifa=0
WHERE id=@id AND numeroTarifa=@numeroTarifa

UPDATE ALMACENAJES
SET aplicaServicio=2
WHERE idUsuarioCliente=@id AND numeroSerie=@numeroTarifa

UPDATE SEGURO
SET aplicaServicio=2
WHERE idUsuarioCliente=@id AND numeroSerie=@numeroTarifa

UPDATE MANEJO
SET aplicaServicio=2
WHERE idUsuarioCliente=@id AND numeroSerie=@numeroTarifa

UPDATE GASTOS_ADMIN
SET aplicaServicio=2
WHERE idUsuarioCliente=@id AND numeroSerie=@numeroTarifa


UPDATE OTROS_GASTOS
SET aplicaServicio=2
WHERE idUsuarioCliente=@id AND numeroSerie=@numeroTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spAsientoContable]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spAsientoContable]
	@cuenta text,
	@idEmpresa int,
	@monto float,
	@estado int,
	@explicacion text,
	@numeroAsignado int,
	@naturaleza text,
	@tipOperaSaldo text,
	@tipConcepto text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @idSaldoCif INT
SET @idSaldoCif = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable802103_0102 WHERE idEmpresa = @idEmpresa)

DECLARE @idSaldoCifImpts INT
SET @idSaldoCifImpts = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable801109_01 WHERE idEmpresa = @idEmpresa)
IF (@idSaldoCifImpts>0 AND @idSaldoCif>0)
BEGIN
DECLARE @error INT
BEGIN TRAN tranAsientoConta
/*idCuenta haciendo get a tabla cuentas contables para guardar su id en la tabla*/
DECLARE @idCuenta INT
SET @idCuenta = (SELECT TOP 1 (id) FROM cuentasContables WHERE cuentasContables.cuenta LIKE @cuenta)
/*EXPLICACION DE LA POLIZA*/
DECLARE @idExplica INT
SET @idExplica = (SELECT TOP 1 (id) FROM explicacionesContables WHERE explicacion LIKE @explicacion)
/*DECLARANDO EL ID AL QUE APLICA LA CUENTA DEBE O HABER*/
DECLARE @idDebHab INT
SELECT @idDebHab =  (SELECT TOP 1 (id) FROM debeHaber WHERE debeHaber.concepto LIKE @naturaleza)
DECLARE @idPoliza INT
INSERT INTO [dbo].[polizasContaFiscal]
           ([idCuenta]
           ,[idEmpresa]
           ,[monto]
           ,[estado]
           ,[idExplicacion]
           ,[numeroPoliza]
           ,[idDebeHaber])
     VALUES
           (@idCuenta
           ,@idEmpresa
           ,@monto
           ,@estado
           ,@idExplica
           ,@numeroAsignado
           ,@idDebHab)
SET @idPoliza = @@IDENTITY
DECLARE @saldoNuevo FLOAT

IF (@cuenta LIKE '802103.0102')
BEGIN

DECLARE @saldoAnterior FLOAT
SET @saldoAnterior = (SELECT saldo FROM saldoContable802103_0102 WHERE id = @idSaldoCif)

IF (@tipOperaSaldo LIKE 'SUMA')
BEGIN
SET @saldoNuevo = (@saldoAnterior+@monto)
END
IF (@tipOperaSaldo LIKE 'RESTA')
BEGIN
SET @saldoNuevo = (@saldoAnterior-@monto)
END


INSERT INTO [dbo].[saldoContable802103_0102] ([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@idEmpresa, @idPoliza, @numeroAsignado, @tipConcepto, @tipOperaSaldo, @monto, ROUND(@saldoNuevo, 2))
END

IF (@cuenta LIKE '801109.01')
BEGIN

DECLARE @saldoAnteriorImpts FLOAT
SET @saldoAnteriorImpts = (SELECT saldo FROM saldoContable801109_01 WHERE id = @idSaldoCifImpts)

IF (@tipOperaSaldo LIKE 'RESTA')
BEGIN
SET @saldoNuevo = (@saldoAnteriorImpts-@monto)
END

IF (@tipOperaSaldo LIKE 'SUMA')
BEGIN
SET @saldoNuevo = (@saldoAnteriorImpts+@monto)
END


INSERT INTO [dbo].[saldoContable801109_01] ([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@idEmpresa, @idPoliza, @numeroAsignado, @tipConcepto, @tipOperaSaldo, @monto, ROUND(@saldoNuevo, 2))
END


SET @error = @@ERROR

IF (@error<>0)
BEGIN 
ROLLBACK TRAN tranAsientoConta
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranAsientoConta
SELECT 1 'resp'
END
END
END
GO
/****** Object:  StoredProcedure [dbo].[spAsientoContableAF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spAsientoContableAF]
	@cuenta text,
	@idEmpresa int,
	@monto float,
	@estado int,
	@explicacion text,
	@numeroAsignado int,
	@naturaleza text,
	@tipOperaSaldo text,
	@tipConcepto text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @idSaldoCif INT
SET @idSaldoCif = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable802103_0102 WHERE idEmpresa = @idEmpresa)

DECLARE @idSaldoCifImpts INT
SET @idSaldoCifImpts = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable801109_01 WHERE idEmpresa = @idEmpresa)

IF (@idSaldoCifImpts>0 AND @idSaldoCif>0)
BEGIN
DECLARE @error INT
BEGIN TRAN tranAsientoConta
/*idCuenta haciendo get a tabla cuentas contables para guardar su id en la tabla*/
DECLARE @idCuenta INT
SET @idCuenta = (SELECT TOP 1 (id) FROM cuentasContables WHERE cuentasContables.cuenta LIKE @cuenta)
/*EXPLICACION DE LA POLIZA*/
DECLARE @idExplica INT
SET @idExplica = (SELECT TOP 1 (id) FROM explicacionesContables WHERE explicacion LIKE @explicacion)
/*DECLARANDO EL ID AL QUE APLICA LA CUENTA DEBE O HABER*/
DECLARE @idDebHab INT
SELECT @idDebHab =  (SELECT TOP 1 (id) FROM debeHaber WHERE debeHaber.concepto LIKE @naturaleza)
DECLARE @idPoliza INT
INSERT INTO [dbo].[polizasContaFiscal]
           ([idCuenta]
           ,[idEmpresa]
           ,[monto]
           ,[estado]
           ,[idExplicacion]
           ,[numeroPoliza]
           ,[idDebeHaber])
     VALUES
           (@idCuenta
           ,@idEmpresa
           ,@monto
           ,@estado
           ,@idExplica
           ,@numeroAsignado
           ,@idDebHab)
SET @idPoliza = @@IDENTITY
DECLARE @saldoNuevo FLOAT
/*
IF (@cuenta LIKE '802103.0102')
BEGIN

DECLARE @saldoAnterior FLOAT
SET @saldoAnterior = (SELECT saldo FROM saldoContable802103_0102 WHERE id = @idSaldoCif)

IF (@tipOperaSaldo LIKE 'SUMA')
BEGIN
SET @saldoNuevo = (@saldoAnterior+@monto)
END
IF (@tipOperaSaldo LIKE 'RESTA')
BEGIN
SET @saldoNuevo = (@saldoAnterior-@monto)
END


INSERT INTO [dbo].[saldoContable802103_0102] ([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@idEmpresa, @idPoliza, @numeroAsignado, @tipConcepto, @tipOperaSaldo, @monto, ROUND(@saldoNuevo, 2))
END
*/
/*
HACIENDO INGRESO A ALMACEN FISCAL
*/
IF (@cuenta LIKE '802103.0101')
BEGIN

DECLARE @saldoAnterior FLOAT
SET @saldoAnterior = (SELECT saldo FROM saldoContable802103_0102 WHERE id = @idSaldoCif)

IF (@tipOperaSaldo LIKE 'SUMA')
BEGIN
SET @saldoNuevo = (@saldoAnterior+@monto)
END
IF (@tipOperaSaldo LIKE 'RESTA')
BEGIN
SET @saldoNuevo = (@saldoAnterior-@monto)
END


INSERT INTO [dbo].[saldoContable802103_0101AF] ([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@idEmpresa, @idPoliza, @numeroAsignado, @tipConcepto, @tipOperaSaldo, @monto, ROUND(@saldoNuevo, 2))
END

IF (@cuenta LIKE '801109.01')
BEGIN

DECLARE @saldoAnteriorImpts FLOAT
SET @saldoAnteriorImpts = (SELECT saldo FROM saldoContable801109_01 WHERE id = @idSaldoCifImpts)

IF (@tipOperaSaldo LIKE 'RESTA')
BEGIN
SET @saldoNuevo = (@saldoAnteriorImpts-@monto)
END

IF (@tipOperaSaldo LIKE 'SUMA')
BEGIN
SET @saldoNuevo = (@saldoAnteriorImpts+@monto)
END


INSERT INTO [dbo].[saldoContable801109_01AF] ([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@idEmpresa, @idPoliza, @numeroAsignado, @tipConcepto, @tipOperaSaldo, @monto, ROUND(@saldoNuevo, 2))
END


SET @error = @@ERROR

IF (@error<>0)
BEGIN 
ROLLBACK TRAN tranAsientoConta
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranAsientoConta
SELECT 1 'resp'
END
END


END
GO
/****** Object:  StoredProcedure [dbo].[spAsientoContableAjuste]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spAsientoContableAjuste]
	@cuenta text,
	@idEmpresa int,
	@monto float,
	@estado int,
	@explicacion text,
	@numeroAsignado int,
	@naturaleza text,
	@tipOperaSaldo text,
	@tipConcepto text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @idSaldoCif INT
SET @idSaldoCif = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable802103_0102 WHERE idEmpresa = @idEmpresa)

DECLARE @idSaldoCifImpts INT
SET @idSaldoCifImpts = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable801109_01 WHERE idEmpresa = @idEmpresa)

IF(@idSaldoCif>=1 AND @idSaldoCifImpts>=1)
BEGIN
DECLARE @error INT
BEGIN TRAN tranAsientoConta
/*idCuenta haciendo get a tabla cuentas contables para guardar su id en la tabla*/
DECLARE @idCuenta INT
SET @idCuenta = (SELECT id FROM cuentasContables WHERE cuentasContables.cuenta LIKE @cuenta)
/*EXPLICACION DE LA POLIZA*/
DECLARE @idExplica INT
SET @idExplica = (SELECT id FROM explicacionesContables WHERE explicacion LIKE @explicacion)
/*DECLARANDO EL ID AL QUE APLICA LA CUENTA DEBE O HABER*/
DECLARE @idDebHab INT
SELECT @idDebHab =  (SELECT id FROM debeHaber WHERE debeHaber.concepto LIKE @naturaleza)
DECLARE @idPoliza INT
INSERT INTO [dbo].[polizasContaFiscal]
           ([idCuenta]
           ,[idEmpresa]
           ,[monto]
           ,[estado]
           ,[idExplicacion]
           ,[numeroPoliza]
           ,[idDebeHaber])
     VALUES
           (@idCuenta
           ,@idEmpresa
           ,@monto
           ,@estado
           ,@idExplica
           ,@numeroAsignado
           ,@idDebHab)
SET @idPoliza = @@IDENTITY
DECLARE @saldoNuevo FLOAT

IF (@cuenta LIKE '802103.0102')
BEGIN

DECLARE @saldoAnterior FLOAT
SET @saldoAnterior = (SELECT saldo FROM saldoContable802103_0102 WHERE id = @idSaldoCif)

IF (@tipOperaSaldo LIKE 'SUMA')
BEGIN
SET @saldoNuevo = (@saldoAnterior+@monto)
END
IF (@tipOperaSaldo LIKE 'RESTA')
BEGIN
SET @saldoNuevo = (@saldoAnterior-@monto)
END


INSERT INTO [dbo].[saldoContable802103_0102] ([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@idEmpresa, 0, @numeroAsignado, @tipConcepto, @tipOperaSaldo, @monto, ROUND(@saldoNuevo, 2))
END

IF (@cuenta LIKE '801109.01')
BEGIN

DECLARE @saldoAnteriorImpts FLOAT
SET @saldoAnteriorImpts = (SELECT saldo FROM saldoContable801109_01 WHERE id = @idSaldoCifImpts)

IF (@tipOperaSaldo LIKE 'RESTA')
BEGIN
SET @saldoNuevo = (@saldoAnteriorImpts-@monto)
END

IF (@tipOperaSaldo LIKE 'SUMA')
BEGIN
SET @saldoNuevo = (@saldoAnteriorImpts+@monto)
END


INSERT INTO [dbo].[saldoContable801109_01] ([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@idEmpresa, 0, @numeroAsignado, @tipConcepto, @tipOperaSaldo, @monto, ROUND(@saldoNuevo, 2))
END


SET @error = @@ERROR

IF (@error<>0)
BEGIN 
ROLLBACK TRAN tranAsientoConta
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranAsientoConta
SELECT 1 'resp'
END
END
END


GO
/****** Object:  StoredProcedure [dbo].[spAsignarEje]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spAsignarEje]
	@id int,
	@ejecutivo int

AS
BEGIN
	SET NOCOUNT ON;
UPDATE CLIENTESSINTARIFA
SET estado = 1, ejecutivo = @ejecutivo, comentarios = 'Ejecutivo Asignado'
WHERE id = @id

END


GO
/****** Object:  StoredProcedure [dbo].[spAsigNumPaseVacio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spAsigNumPaseVacio]
	@valor int,
	@estado int,
	@asignar int,
	@idUsuario int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN estadoRetTran

DECLARE @asigNum int
SET @asigNum = (SELECT COUNT(*) FROM numAsignadoPaseVacio WHERE idUnidad = 873)

DECLARE @countRet INT
SET @countRet = (SELECT ISNULL(COUNT(*),0) from datosUnidades where idOp = 873 AND tipoOp = 2 AND estado >= 1)
select @asigNum
select @countRet

IF (@countRet>=1)
BEGIN

		DECLARE @idIng INT
		SET @idIng = (SELECT idOp FROM datosUnidades WHERE id = 873)



		DECLARE @inicioCor INT
		SET @inicioCor = (SELECT numeroInicio FROM inicioCorrelativos)
		

		DECLARE @idIdenty INT
		SET @idIdenty = (SELECT ing.identBodega FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = 873)

		DECLARE @fecha DATETIME
		SET @fecha = GETDATE();

		/*ASIGNANDO NUMERO DE EN CORRELATIVO DE RETIROS*/
		/*SABER SI EXISTE UN CORRELATIVO*/
			DECLARE @proximo_numero INT
			DECLARE @categoria INT
			SET @categoria = (SELECT id FROM vinculosDeBodegas WHERE id = @idIdenty)
			DECLARE @idNombreCorrel INT
			SET @idNombreCorrel = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'PASE_VACIO')
			DECLARE @estdCorrelativo INT
			SET @estdCorrelativo = (SELECT COUNT(*) FROM numeradorCorrelativos WHERE idCategoria = @categoria AND idnomCorrelativo = @idNombreCorrel )
			/*LA FECHA ES UN PARAMETRO DE BITACORA, YA QUE SINO SE MANDA GENERA UN ERROR EL STORE PRODUCE*/
			EXECUTE spBitacoraRet @valor, 'Retiro Vacio', @idUsuario,  1, @fecha;	

	IF (@estdCorrelativo=0)
	BEGIN
			EXECUTE spInicioNumerador @categoria, @idNombreCorrel, 0
	END
			UPDATE numeradorCorrelativos SET @proximo_numero = ultimoNumero = ultimoNumero + 1
			WHERE idCategoria =  @categoria AND idnomCorrelativo = @idNombreCorrel
			INSERT INTO numAsignadoRetiros VALUES (@valor, @idIng, @idIdenty, @proximo_numero, getdate())

			/*FIN DE ASIGNACION DE RETIRO*/
			SET @error = @@ERROR

	END

		IF (@error<>0)	
	BEGIN
			ROLLBACK TRAN estadoRetTran
			SELECT 0 AS 'resp'		
	END
	ELSE
	BEGIN
			COMMIT TRAN estadoRetTran
			SELECT 1 AS 'resp'		
	END




END

GO
/****** Object:  StoredProcedure [dbo].[spAutAnulaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spAutAnulaIng]
	@idIngreso int,
	@token text,
	@fecha datetime,
	@comentario text,
	@usuario int,
	@estado int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error  int
begin tran tranAnula

INSERT INTO [dbo].[autoDeAnulaIng]
 ([idIngreso], [token], [fecha], [comentario], [usuario], [estado]) VALUES
(@idIngreso, @token, @fecha, @comentario, @usuario, @estado)

set @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranAnula
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranAnula
SELECT 1 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spBitacoraIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spBitacoraIng]
@idIngreso int,
@transaccion text,
@idUsuario int,
@tipo int
	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[bitacoraIngresos]
           ([idIngreso]
           ,[transaccion]
           ,[idUsuario]
           ,[fecha])
     VALUES
           (@idIngreso
           ,@transaccion
           ,@idUsuario
           ,GETDATE())
		   IF (@tipo=1)
		   BEGIN
		   SELECT @@IDENTITY AS 'Identity'
		   END
		   

END
GO
/****** Object:  StoredProcedure [dbo].[spBitacoraRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spBitacoraRet]
@idIdOpera int,
@transaccion text,
@idUsuario int,
@tipo int,
@calc datetime
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN NuevaTran
INSERT INTO [dbo].[bitacoraRetiroCalculo]
           ([idOpera]
           ,[transaccion]
           ,[idUsuario]
           ,[tipo]
           ,[fecha])
     VALUES
           (@idIdOpera
           ,@transaccion
           ,@idUsuario
           ,@tipo
           ,GETDATE())
END
IF (@tipo = 2)
BEGIN
EXECUTE spSubBitacoraCal @@IDENTITY, @calc
END

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN NuevaTran
END
ELSE
BEGIN
COMMIT TRAN NuevaTran
END
GO
/****** Object:  StoredProcedure [dbo].[spBltsIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spBltsIng]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

 SELECT bultos FROM valoresIngOpFiscal WHERE id=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spBorrarUnidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spBorrarUnidad]
@idUnidad int,
@estado int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranBorrarUnidad
UPDATE datosUnidades
SET datosUnidades.estado = @estado WHERE datosUnidades.id = @idUnidad
END
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranBorrarUnidad
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranBorrarUnidad
SELECT 1 'resp'
END



GO
/****** Object:  StoredProcedure [dbo].[spBultosIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spBultosIng]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idBultos int
SET @idBultos = (SELECT idIngreso FROM detalleDeMercaderia WHERE id = @valor)
SELECT SUM(bultos) AS 'bultosIngOp' FROM valoresIngOpFiscal WHERE idIngreso=@idBultos



END


GO
/****** Object:  StoredProcedure [dbo].[spBultosIngN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spBultosIngN]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT ISNULL(SUM(bultos),0) AS 'bultosIngOp' FROM valoresIngOpFiscal WHERE idIngreso=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spBusquedaConsolidado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spBusquedaConsolidado]

AS
BEGIN
	SET NOCOUNT ON;


SELECT id, consolidado FROM empresasConsolidadas 

END


GO
/****** Object:  StoredProcedure [dbo].[spBusquedaInc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spBusquedaInc]
	@busqueda text
AS
BEGIN
	SET NOCOUNT ON;


	SELECT TOP(25)nombreEmpresa FROM nit WHERE nombreEmpresa LIKE CONCAT(@busqueda,'%')
	

END


GO
/****** Object:  StoredProcedure [dbo].[spCadenaPlt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spCadenaPlt]
	@idIng int

AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @inci int
	SET @inci = (SELECT COUNT(*) FROM incidencia WHERE idIngreso = @idIng)

	DECLARE @detalle int
	SET @detalle = (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso = @idIng)

	DECLARE @diferencia int
	SET @diferencia = (@detalle-@inci)

DECLARE @cadena char(32);  
SET @cadena = (select cadenaVinculo from ingresosConsolidadoPoliza WHERE idIngreso = @idIng)

SELECT dtUni.id AS 'operacion', dtUni.idOp AS 'idIngreso', plt.licencia,
plt.piloto, dtUni.marchamo, unPlaca.placa, unC.contenedor, cons.estadoOperacion, cons.id as 'cadenaPase'
, ISNULL(psSal.idUnidad, 0) AS 'unidad', ingPol.estadoIngreso AS 'estadoIngreso', @diferencia AS 'diferencia',
ingPol.id AS 'idIngOp', ingPol.numeroPoliza, dtUni.id as 'idUnidad', dtUni.estado

 FROM ingresosConsolidadoPoliza cons
INNER JOIN datosUnidades dtUni ON cons.idIngreso = dtUni.idOp AND cons.cadenaVinculo LIKE @cadena AND cons.tipoOperacion = 1 AND
dtUni.tipoOp = 1
INNER JOIN pilotos plt ON plt.id = dtUni.piloto
INNER JOIN unidadesPlacas unPlaca ON unPlaca.id = dtUni.unidadPlaca 
INNER JOIN unidadesContenedores unC ON unC.id = dtUni.unidadContenedor
LEFT JOIN pasesDeSalida psSal ON psSal.idUnidad = dtUni.id
INNER JOIN ingresoOperacionFiscal ingPol ON cons.idIngreso = ingPol.id

END


GO
/****** Object:  StoredProcedure [dbo].[spCadenaPltNormal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spCadenaPltNormal]
	@idIng int

AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @inci int
	SET @inci = (SELECT COUNT(*) FROM incidencia WHERE idIngreso = @idIng)

	DECLARE @detalle int
	SET @detalle = (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso = @idIng)

	DECLARE @diferencia int
	SET @diferencia = (@detalle-@inci)

DECLARE @cadena char(32);  
SET @cadena = (select cadenaVinculo from ingresosConsolidadoPoliza WHERE idIngreso = @idIng)

SELECT dtUni.id AS 'operacion', dtUni.idOp AS 'idIngreso', plt.licencia,
plt.piloto, dtUni.marchamo, unPlaca.placa, unC.contenedor, cons.estadoOperacion, cons.id as 'cadenaPase'
, ISNULL(psSal.idUnidad, 0) AS 'unidad', ingPol.estadoIngreso AS 'estadoIngreso', @diferencia AS 'diferencia',
ingPol.id AS 'idIngOp', ingPol.numeroPoliza, dtUni.id as 'idUnidad'

 FROM ingresosConsolidadoPoliza cons
INNER JOIN datosUnidades dtUni ON cons.idIngreso = dtUni.idOp AND cons.cadenaVinculo LIKE @cadena AND cons.tipoOperacion = 1 AND
dtUni.tipoOp = 1
INNER JOIN pilotos plt ON plt.id = dtUni.piloto
INNER JOIN unidadesPlacas unPlaca ON unPlaca.id = dtUni.unidadPlaca 
INNER JOIN unidadesContenedores unC ON unC.id = dtUni.unidadContenedor
LEFT JOIN pasesDeSalida psSal ON psSal.idUnidad = dtUni.id
INNER JOIN ingresoOperacionFiscal ingPol ON cons.idIngreso = ingPol.id

END


GO
/****** Object:  StoredProcedure [dbo].[spCadenaPltUnidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spCadenaPltUnidad]
	@idIng int

AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @inci int
	SET @inci = (SELECT COUNT(*) FROM incidencia WHERE idIngreso = 2474)

	DECLARE @detalle int
	SET @detalle = (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso = 2474)

	DECLARE @diferencia int
	SET @diferencia = (@detalle-@inci)


SELECT dtUni.id AS 'operacion', dtUni.idOp AS 'idIngreso', plt.licencia,
plt.piloto, dtUni.marchamo, unPlaca.placa, unC.contenedor
, ISNULL(psSal.idUnidad, 0) AS 'unidad', ingPol.estadoIngreso AS 'estadoIngreso', @diferencia AS 'diferencia',
ingPol.id AS 'idIngOp', ingPol.numeroPoliza, dtUni.id as 'idUnidad'

 FROM datosUnidades dtUni 
INNER JOIN pilotos plt ON plt.id = dtUni.piloto and dtUni.tipoOp = 1
INNER JOIN unidadesPlacas unPlaca ON unPlaca.id = dtUni.unidadPlaca 
INNER JOIN unidadesContenedores unC ON unC.id = dtUni.unidadContenedor
LEFT JOIN pasesDeSalida psSal ON psSal.idUnidad = dtUni.id
INNER JOIN ingresoOperacionFiscal ingPol ON ingPol.id = dtUni.idOp and ingPol.id = 2474

END


GO
/****** Object:  StoredProcedure [dbo].[spCantCadenasConsolidado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spCantCadenasConsolidado]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;


DECLARE @cadena varchar(100)
SET @cadena = (select cadenaVinculo from ingresosConsolidadoPoliza where idIngreso = @valor)


SELECT COUNT(*) as 'cantCadenas'
FROM ingresoOperacionFiscal ing
inner join ingresosConsolidadoPoliza ingCon ON ingCon.idIngreso = ing.id and ingCon.cadenaVinculo like @cadena and ing.estadoIngreso>=1
left join detalleDeMercaderia det on det.idIngreso = ing.id

END


GO
/****** Object:  StoredProcedure [dbo].[spCartaDeMillon]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spCartaDeMillon]
@fecha datetime
	AS
BEGIN
	SET NOCOUNT ON;

select ISNULL(personal.foto, 'NA') AS 'foto', personal.nombres, personal.apellidos,
convert(varchar, ret.fechaEmision, 25) AS 'fechaEmision', 
ret.polizaRetiro, nit.nombreEmpresa from retiroOperacionFiscal ret
INNER JOIN valoresRetirosFiscal val ON val.idRet = ret.id
INNER JOIN nit ON nit.id = ret.idNit
INNER JOIN personal ON personal.id = ret.idUsuario
WHERE (val.totalValorCif+val.valorImpuesto)>=500000 AND ret.estadoRet >= 1 AND ret.estadoRet <= 3 AND ret.fechaEmision >= @fecha
ORDER BY  ret.fechaEmision DESC

END


GO
/****** Object:  StoredProcedure [dbo].[spCartaDeMillonCount]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spCartaDeMillonCount]
@fecha datetime
	AS
BEGIN
	SET NOCOUNT ON;

select COUNT(*) AS 'cantidadMedioM' from retiroOperacionFiscal ret
INNER JOIN valoresRetirosFiscal val ON val.idRet = ret.id
INNER JOIN nit ON nit.id = ret.idNit
INNER JOIN personal ON personal.id = ret.idUsuario
WHERE (val.totalValorCif+val.valorImpuesto)>=500000 AND ret.estadoRet >= 1 AND ret.estadoRet <= 3 AND ret.fechaEmision >= @fecha


END


GO
/****** Object:  StoredProcedure [dbo].[spChasisVNuevo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spChasisVNuevo]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT chas.id, nit.nombreEmpresa, ret.polizaRetiro, chas.chasis, tipo.tipoVehiculo,
med.linea, prd.predio, prd.descripcion
FROM retiroOperacionFiscal ret
INNER JOIN chasisVehiculosNuevos chas ON ret.id = chas.idRet
left JOIN tiposDeVehiculos tipo ON tipo.id = chas.tipoVehiculo
INNER JOIN medidasVehiculos med on med.id = chas.lineaVehiculo
INNER JOIN nit on nit.id = ret.idNit
left JOIN prediosDeVehiculos prd on prd.id = chas.ubicacion
WHERE ret.id = @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spClienteSinT]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spClienteSinT]
@idIngreso int,
@identBodega int,
@idNit int,
@idUsuario int,
@estado int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @idTar INT
SET @idTar = (SELECT COUNT(*) FROM usuariosExternos WHERE idNit= @idNit)


DECLARE @reportado INT
SET @reportado = (SELECT COUNT(*) FROM clientesSinTarifa WHERE idNit = @idNit)

IF (@idTar=0 AND @reportado = 0) 
BEGIN
DECLARE @nitVerifica int
	SET @nitVerifica = (SELECT COUNT(*) FROM clientesSinTarifa WHERE idNit = 4560)
IF(@nitVerifica=0)	
BEGIN
INSERT INTO [dbo].[clientesSinTarifa]
           ([idIngreso]
           ,[identBodega]
           ,[idNit]
           ,[idUsuario]
           ,[estado])
     VALUES
(@idIngreso,
@identBodega,
@idNit,
@idUsuario,
@estado)
END
END
END
GO
/****** Object:  StoredProcedure [dbo].[spClienteTar]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spClienteTar]
@idNit int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT *   FROM clientesSinTarifa WHERE idNit = @idNit

END
GO
/****** Object:  StoredProcedure [dbo].[spCltDataRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spCltDataRet]
@idRet int,
@tipoCons int
	AS
BEGIN
	SET NOCOUNT ON;
IF (@tipoCons=0)
BEGIN
SELECT personal.nombres, personal.apellidos from bitacoraRetiroCalculo
INNER JOIN personal ON personal.id = bitacoraRetiroCalculo.idUsuario AND bitacoraRetiroCalculo.idOpera = @idRet AND bitacoraRetiroCalculo.transaccion like 'Recibo%' 
END
IF (@tipoCons=1)
BEGIN
SELECT personal.nombres, personal.apellidos from bitacoraRetiroCalculo
INNER JOIN personal ON personal.id = bitacoraRetiroCalculo.idUsuario AND bitacoraRetiroCalculo.idOpera = @idRet AND bitacoraRetiroCalculo.transaccion like 'Rebaja POS MTS%' 
END
IF (@tipoCons=2)
BEGIN
SELECT personal.nombres, personal.apellidos from bitacoraRetiroCalculo
INNER JOIN personal ON personal.id = bitacoraRetiroCalculo.idUsuario AND bitacoraRetiroCalculo.idOpera = @idRet AND bitacoraRetiroCalculo.transaccion like 'Retiro Fiscal%' 
END
END
GO
/****** Object:  StoredProcedure [dbo].[spCltDatosSal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spCltDatosSal]
@idRet int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT  

ntIng.nitEmpresa AS 'nitEmpresaIng', ntIng.nombreEmpresa AS 'nombreEmpresa', ingOp.numeroPoliza AS 'numPol', ingOp.id+10000 AS 'numIng',
convert(varchar(12),valIng.fechaRealIng,105) AS 'fechaIng', convert(varchar(12),retFOp.fechaEmision,105) AS 'fechaSalida',
 nitSal.nitEmpresa AS 'nitSalida', nitSal.nombreEmpresa AS 'empresaSalida', nitSal.direccionEmpresa AS 'direccEmpresa',
retFOp.polizaRetiro AS 'polRetiro'

FROM retiroOperacionFiscal retFOp
INNER JOIN valoresRetirosFiscal sdlfR ON retFOp.id = sdlfR.idRet AND retFOp.id = @idRet
left JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retFOp.idIngresosOP
left JOIN detalleDeMercaderia detR ON detR.id =  retFOp.idIngresosOP 

left JOIN nit ntIng ON ntIng.id = ingOp.idNit
left JOIN nit nitSal ON nitSal.id = retFOp.idNit
left JOIN valoresIngOpFiscal valIng ON valIng.idIngreso = ingOp.id



END
GO
/****** Object:  StoredProcedure [dbo].[spCltEjecutivo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spCltEjecutivo]
	@idNit int

AS
BEGIN
	SET NOCOUNT ON;


SELECT per.nombres AS 'nmbre', per.apellidos AS 'appell', per.email as 'correo', per.telefono AS 'cel', per.foto as'picture', per.departamento AS 'depto' FROM clientesSinTarifa clsT 
INNER JOIN personal per ON clsT.idNit = @idNit AND per.id = clsT.ejecutivo
END


GO
/****** Object:  StoredProcedure [dbo].[spCltSinTar]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spCltSinTar]

	AS
BEGIN
	SET NOCOUNT ON;



SELECT cltSin.id AS 'idRegistroCliente',nt.id AS 'indentyNit', nt.nitEmpresa AS 'nit', nt.nombreEmpresa AS 'empresa', nt.direccionEmpresa AS 'direcc',
ing.idCartaCupo 'cCupo', per.nombres AS 'nomAuxiliar',
per.apellidos AS 'apeAuxiliar', emp.empresa AS 'empOrigen', bod.areasAutorizadas AS 'areaOrigen',
	 bod.numeroIdentidad AS 'areaNumOrigen', per.foto, cltSin.estado AS 'estadoCliente', ISNULL(cltSin.ejecutivo,0) AS 'ejecutivoAsignado'
FROM clientesSinTarifa cltSin
INNER JOIN NIT nt ON nt.id =  cltSin.idNit AND cltSin.estado <=1
INNER JOIN ingresoOperacionFiscal ing ON cltSin.idIngreso = ing.id
INNER JOIN personal per ON per.id = cltSin.idUsuario
INNER JOIN bodegas bod ON bod.id = ing.identBodega
INNER JOIN empresas emp ON emp.id = bod.dependencia 


END
GO
/****** Object:  StoredProcedure [dbo].[spCobroManejos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spCobroManejos]
@idRegistroCobro int,
@idIngreso int,
@rubrosManejos float

	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[cobrosManejoFiscal]
           ([idRegistroCobro]
           ,[idIngreso]
           ,[rubrosManejos])
     VALUES
           (@idRegistroCobro
           ,@idIngreso
           ,@rubrosManejos)

END
GO
/****** Object:  StoredProcedure [dbo].[spCobroSeguro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spCobroSeguro]
@idRegistroCobro int,
@idIngreso int,
@rubrosSeguro float

	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[cobrosSeguroFiscal]
           ([idRegistroCobro]
           ,[idIngreso]
           ,[rubrosSeguro])
     VALUES
           (@idRegistroCobro
           ,@idIngreso
           ,@rubrosSeguro)

END
GO
/****** Object:  StoredProcedure [dbo].[spCobrosFiscalRev]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spCobrosFiscalRev]
	@idIngreso int

AS
BEGIN
	SET NOCOUNT ON;

SELECT fechaCobro FROM cobrosAlmacenajesFiscal WHERE idIngreso = @idIngreso

END


GO
/****** Object:  StoredProcedure [dbo].[spConfiNavega]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spConfiNavega]
@bodega text,
@numBodega int,
@valorId int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT db.id AS 'idDeBodega', ep.empresa AS 'nombreEmpresa', db.areasAutorizadas AS 'Area', 
db.numeroIdentidad AS 'numeroArea', db.id AS 'numIdBod' FROM EMPRESAS ep
INNER JOIN BODEGAS db ON ep.id = db.dependencia AND areasAutorizadas LIKE CONCAT('%',@bodega,'%')
AND db.numeroIdentidad = @numBodega AND ep.id = @valorId
	

END


GO
/****** Object:  StoredProcedure [dbo].[spConsServ]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spConsServ]
	@idUSX int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @catAlm VARCHAR(50)
SET @catAlm = 'ALMACENAJE'
DECLARE @catSeg VARCHAR(50)
SET @catSeg = 'SEGURO'
DECLARE @catMan VARCHAR(50)
SET @catMan = 'MANEJO'
DECLARE @catGtAdmin VARCHAR(50)
SET @catGtAdmin = 'GASTOS ADMINISTRACIÃ“N'
DECLARE @otrosGts VARCHAR(50)
SET @otrosGts = 'OTROS GASTOS'

SELECT 
servicios.servicio AS 'categoria',

@catAlm AS 'subAlm',
almacenajes.baseCalculo as 'baseAlm',
isnull(almacenajes.periodoCalculo, 'SD') AS 'periodoCalc',
almacenajes.calculoSobre AS 'calcSAlm',
almacenajes.Moneda as 'monedaAlm',
almacenajes.valorTarifa AS 'valTar',

@catSeg AS 'subSeguro',
isnull(seguro.periodSeguro, 'SD') AS  'periodoSeg',
seguro.baseSeguro AS 'basSeg',
seguro.periodoCalculo AS 'perCalcSeg',
seguro.monedaCalculo AS 'monSeg',
seguro.valorSeguro AS 'valSeg',

@catMan AS 'manCat',
isnull(manejo.baseManejo,'SD') AS 'bsManejo',
manejo.monedaCalculo AS 'monCalcManejo',
manejo.valorManejo AS 'valManejo', 

@catGtAdmin AS 'gtsAdmin',
isnull(gastos_Admin.basegastosAdmin, 'SD') AS 'baseGtAd',
gastos_Admin.monedaCalculo AS 'monGst',
gastos_Admin.valorgastosAdmin AS 'valGstAd',

@otrosGts AS 'otrGastos',
isnull(OTROS_GASTOS.baseotrosGastos, 'SD') AS 'basOtrosG',
OTROS_GASTOS.monedaCalculo AS 'monOtrosG',
OTROS_GASTOS.valorotrosGastos AS 'valOtrosG'

FROM
usuariosExternos
FULL OUTER JOIN almacenajes ON almacenajes.idUsuarioCliente = usuariosExternos.id
FULL OUTER JOIN seguro ON seguro.idTarifa = almacenajes.idTarifa
FULL OUTER JOIN manejo ON manejo.idTarifa = almacenajes.idTarifa
FULL OUTER JOIN gastos_Admin ON gastos_Admin.idTarifa = almacenajes.idTarifa
FULL OUTER JOIN OTROS_GASTOS ON OTROS_GASTOS.idTarifa = almacenajes.idTarifa
FULL OUTER JOIN nit ON nit.id = usuariosExternos.idNit
FULL OUTER JOIN servicios ON servicios.id = almacenajes.idServicio
FULL OUTER JOIN personal ON personal.id = usuariosExternos.ejecutivoVentas

WHERE usuariosExternos.id = @idUSX

END


GO
/****** Object:  StoredProcedure [dbo].[spConstReg]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spConstReg]
	AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM REGIMEN




END
GO
/****** Object:  StoredProcedure [dbo].[spConsulIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spConsulIng]
@idCliente int,
@idUsuario int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT  nit.nombreEmpresa AS 'empresa', ingOP.numeroPoliza AS 'poliza', ingOP.numeroIngreso AS 'ingreso', sldF.fechaRealIng AS 'fechaReal'
FROM USUARIOSEXTERNOS ext 
INNER JOIN INGOPERACION ingOP ON ingOP.idUsuarioCliente=ext.id AND ingOP.idUsuarioCliente=1 AND ingOP.id=1
INNER JOIN SALDOS_FISCALES sldF ON ingOP.id = sldF.idIngreso AND sldF.idRetiro = 0 AND sldF.estadoSaldo = 1
INNER JOIN NIT nit ON ext.idNit = nit.id
 

END


GO
/****** Object:  StoredProcedure [dbo].[spConsulNitTar]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spConsulNitTar]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
nt.id AS 'idNit', 
nt.nitEmpresa AS 'nitEmpresa', 
usEX.nombreComercial AS 'nombreComercial',
nt.nombreEmpresa AS 'razonSocial', 
nt.direccionEmpresa AS 'direccionFiscal', 
usEX.direccionDeRecibos AS 'direccionRec', 
usEX.telefono AS 'tel',
usEX.estadoTarifa,
usEX.email AS 'correo',
persEjec.id AS 'identEjec',
persEjec.telefono AS 'telEjec',
CONCAT(usEX.nombres, ' ', usEX.apellidos) AS 'nombreContacto',

CONCAT(persEjec.nombres, ' ', persEjec.apellidos) AS 'ejecutivo',
persEjec.telefono AS 'celEje',
persEjec.email AS 'correoEje',
usEX.id as 'usuarioID'
FROM nit nt
INNER JOIN usuariosExternos usEX ON nt.id = usEX.idNit AND usEX.id = @valor
INNER JOIN personal persEjec ON persEjec.id = usEX.ejecutivoVentas

END


GO
/****** Object:  StoredProcedure [dbo].[spConsultaBltPs]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spConsultaBltPs]
@idIng int
	AS
BEGIN
	SET NOCOUNT ON;

select bultos, peso from valoresIngOpFiscal
where idIngreso = @idIng

END


GO
/****** Object:  StoredProcedure [dbo].[spConsultaChasCorreo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spConsultaChasCorreo]
@chasis text

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @inicio INT
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)

select tras.id as 'idChasSalida', ing.id as 'idIng', ret.id as 'idRet', chas.chasis, med.linea, tip.tipoVehiculo,
isnull(tras.cif, 0) AS 'cif', ISNULL(tras.impuesto, 0) AS 'impuesto',  tras.valUnitario, ret.polizaRetiro,
ing.numeroPoliza, retAs.numeroAsignado + @inicio AS 'numeroAsig',
val.fechaRealIng, tras.estado, nit.nitEmpresa, nit.nombreEmpresa
FROM trasladoFiscalVeh tras
inner join retiroOperacionFiscal ret ON ret.id = tras.idRet
inner join chasisVehiculosNuevos chas ON chas.id = tras.chasis
inner join medidasVehiculos med ON med.id = chas.lineaVehiculo
inner join tiposDeVehiculos tip on tip.id  = chas.tipoVehiculo
inner join ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP 
inner join numAsignadoRetiros retAs ON retAs.idRet = ret.id
inner join valoresIngOpFiscal val ON val.idIngreso = ret.idIngresosOP 
inner join nit on nit.id = ing.idNit
and chas.chasis like @chasis
END


GO
/****** Object:  StoredProcedure [dbo].[spConsultaChasis]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spConsultaChasis]
@id int,
@empresa text
	AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'contChasis' FROM detalleDeMercaderia WHERE idIngreso = @id and empresa like CONCAT (@empresa,'%')

END
GO
/****** Object:  StoredProcedure [dbo].[spConsultaChasSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spConsultaChasSalida]

@idBodega int

	AS
BEGIN
	SET NOCOUNT ON;


DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @inicio INT
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)

select chas.chasis, med.linea, tip.tipoVehiculo,
isnull(tras.cif, 0) AS 'cif', ISNULL(tras.impuesto, 0) AS 'impuesto',  tras.valUnitario, ret.polizaRetiro,
ing.numeroPoliza, retAs.numeroAsignado + @inicio AS 'numeroAsig',
val.fechaRealIng, tras.estado, nit.nitEmpresa, nit.nombreEmpresa
FROM trasladoFiscalVeh tras
inner join retiroOperacionFiscal ret ON ret.id = tras.idRet
inner join chasisVehiculosNuevos chas ON chas.id = tras.chasis
inner join medidasVehiculos med ON med.id = chas.lineaVehiculo
inner join tiposDeVehiculos tip on tip.id  = chas.tipoVehiculo
inner join ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP 
INNER JOIN bodegas on bodegas.id = ing.identBodega and bodegas.dependencia = @dependencia
inner join numAsignadoRetiros retAs ON retAs.idRet = ret.id
inner join valoresIngOpFiscal val ON val.idIngreso = ret.idIngresosOP 
inner join nit on nit.id = ing.idNit
AND tras.estado = 0

END
GO
/****** Object:  StoredProcedure [dbo].[spConsultaChasSinConta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spConsultaChasSinConta]
@estado int,
@idBodega int
	AS
BEGIN
	SET NOCOUNT ON;


DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @inicio INT
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)
IF(@estado<=1)
BEGIN
SELECT tras.id as 'idTrasChas', chas.chasis, med.linea, tip.tipoVehiculo,
isnull(tras.cif, 0) AS 'cif', ISNULL(tras.impuesto, 0) AS 'impuesto',  tras.valUnitario, ret.polizaRetiro,
ing.numeroPoliza, retAs.numeroAsignado + @inicio AS 'numeroAsig',
val.fechaRealIng, tras.fechaSalida, tras.fechaEmision, tras.estado, nit.nitEmpresa, nit.nombreEmpresa, gpr.nombreEmpresa as 'grupoEmpresa'
FROM trasladoFiscalVeh tras
left join retiroOperacionFiscal ret ON ret.id = tras.idRet
left join chasisVehiculosNuevos chas ON chas.id = tras.chasis
left join medidasVehiculos med ON med.id = chas.lineaVehiculo
left join tiposDeVehiculos tip on tip.id  = chas.tipoVehiculo
left join ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP 
INNER JOIN bodegas on bodegas.id = ing.identBodega and bodegas.dependencia = @dependencia
left join numAsignadoRetiros retAs ON retAs.idRet = ret.id
left join valoresIngOpFiscal val ON val.idIngreso = ret.idIngresosOP 
left join agrupacionEmpresas agpr on agpr.idNitVeh = ret.idNit
left join grupoEmpresas gpr on gpr.id = agpr.idEmpGp
left join nit on nit.id = ing.idNit
where tras.estado <=@estado
END
ELSE
BEGIN
SELECT tras.id as 'idTrasChas', chas.chasis, med.linea, tip.tipoVehiculo,
isnull(tras.cif, 0) AS 'cif', ISNULL(tras.impuesto, 0) AS 'impuesto',  tras.valUnitario, ret.polizaRetiro,
ing.numeroPoliza, retAs.numeroAsignado + @inicio AS 'numeroAsig', retAs.numeroAsignado + @inicio as 'numeroRetiro', 
val.fechaRealIng, tras.fechaSalida, tras.fechaEmision, tras.estado, nit.nitEmpresa, nit.nombreEmpresa, gpr.nombreEmpresa as 'grupoEmpresa',
ingAsig.numeroAsignado+@inicio as 'numeroIngreso', nitRet.nombreEmpresa as 'empresaRet', convert(varchar, tras.fechaContabilidad, 23) as 'fechaContabilidad'
FROM trasladoFiscalVeh tras
left join retiroOperacionFiscal ret ON ret.id = tras.idRet
left join chasisVehiculosNuevos chas ON chas.id = tras.chasis
left join medidasVehiculos med ON med.id = chas.lineaVehiculo
left join tiposDeVehiculos tip on tip.id  = chas.tipoVehiculo
left join ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP 
INNER JOIN bodegas on bodegas.id = ing.identBodega and bodegas.dependencia = @dependencia
left join numAsignadoIngresos ingAsig ON ingAsig.idIng = ret.idIngresosOP
left join numAsignadoRetiros retAs ON retAs.idRet = ret.id
left join valoresIngOpFiscal val ON val.idIngreso = ret.idIngresosOP 
left join agrupacionEmpresas agpr on agpr.idNitVeh = ret.idNit
left join grupoEmpresas gpr on gpr.id = agpr.idEmpGp
left join nit on nit.id = ing.idNit
left join nit nitRet on nitRet.id = ret.idNit
WHERE tras.estado = @estado
END

END
GO
/****** Object:  StoredProcedure [dbo].[spConsultaEmppresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spConsultaEmppresa]
@idBodega INT

	AS
BEGIN
	SET NOCOUNT ON;

select empresas.id as 'idEmpresa' from bodegas 
INNER JOIN empresas ON empresas.id = bodegas.dependencia AND bodegas.id = @idBodega


END
GO
/****** Object:  StoredProcedure [dbo].[spConsultaPredios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spConsultaPredios]
@idDepe int
	AS
BEGIN
	SET NOCOUNT ON;

select id AS 'idPredio', predio AS 'pred', descripcion  AS 'descP', idDependencia AS 'dependen' from prediosDeVehiculos
where idDependencia = @idDepe

END
GO
/****** Object:  StoredProcedure [dbo].[spConsultaRetUnidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spConsultaRetUnidad]
@idaDatoOp int,
@tipo int,
@estado int

	AS
BEGIN
	SET NOCOUNT ON;
IF (@estado=0)
BEGIN
SELECT 
pilotos.licencia AS 'licPiloto',
pilotos.piloto AS 'nombrePiloto',
unidadesPlacas.placa AS 'placaUnidad',
unidadesContenedores.contenedor AS 'contenedorUnidad',
datosUnidades.marchamo AS 'numMarchamo',
ISNULL(datosUnidades.estado, -1) AS 'estadoUnidad',
datosUnidades.id AS 'Identity'
FROM datosUnidades
LEFT JOIN unidadesContenedores ON unidadesContenedores.id = datosUnidades.unidadContenedor
LEFT JOIN unidadesPlacas ON unidadesPlacas.id = datosUnidades.unidadPlaca
LEFT JOIN pilotos ON pilotos.id = datosUnidades.piloto 
WHERE datosUnidades.idOp = @idaDatoOp AND datosUnidades.tipoOp = @tipo
END
IF (@estado=1)
BEGIN
SELECT 
pilotos.licencia AS 'licPiloto',
pilotos.piloto AS 'nombrePiloto',
unidadesPlacas.placa AS 'placaUnidad',
unidadesContenedores.contenedor AS 'contenedorUnidad',
datosUnidades.marchamo AS 'numMarchamo',
ISNULL(datosUnidades.estado, -1) AS 'estadoUnidad',
datosUnidades.id AS 'Identity'
FROM datosUnidades
LEFT JOIN unidadesContenedores ON unidadesContenedores.id = datosUnidades.unidadContenedor
LEFT JOIN unidadesPlacas ON unidadesPlacas.id = datosUnidades.unidadPlaca
LEFT JOIN pilotos ON pilotos.id = datosUnidades.piloto 
WHERE datosUnidades.id = @idaDatoOp AND datosUnidades.tipoOp = @tipo
END

END


GO
/****** Object:  StoredProcedure [dbo].[spConsultaRetUnidadRev]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spConsultaRetUnidadRev]
@idaDatoOp int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
pilotos.licencia AS 'licPiloto',
pilotos.piloto AS 'nombrePiloto',
unidadesPlacas.placa AS 'placaUnidad',
unidadesContenedores.contenedor AS 'contenedorUnidad',
datosUnidades.marchamo AS 'numMarchamo'
FROM datosUnidades
LEFT JOIN unidadesContenedores ON unidadesContenedores.id = datosUnidades.unidadContenedor
LEFT JOIN unidadesPlacas ON unidadesPlacas.id = datosUnidades.unidadPlaca
LEFT JOIN pilotos ON pilotos.id = datosUnidades.piloto 
WHERE datosUnidades.id = @idaDatoOp
END


GO
/****** Object:  StoredProcedure [dbo].[spConsultaTipoV]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spConsultaTipoV]
@tipo text,
@linea text

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idTipo int 
SET @idTipo = (SELECT id FROM tiposDeVehiculos WHERE tipoVehiculo like @tipo)


DECLARE @idLinea int 
SET @idLinea = (SELECT id FROM medidasVehiculos WHERE linea like @linea)
SELECT ISNULL(@idTipo, 0) AS 'tipoVe', ISNULL(@idLinea, 0) AS 'lineaVe'
		  



END



GO
/****** Object:  StoredProcedure [dbo].[spConsultaTrasladosAF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spConsultaTrasladosAF]
	@idBodega int

AS
BEGIN
	SET NOCOUNT ON;



DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)

select ing.id, nit.nitEmpresa, nit.nombreEmpresa, ing.numeroPoliza, val.bultos, val.totalValorCif, val.valorImpuesto from inventarioFiscal inv
inner join ingresoOperacionFiscal ing on ing.id = inv.idIngreso
INNER JOIN bodegas on bodegas.id = ing.identBodega and bodegas.dependencia = @dependencia
inner join valoresIngOpFiscal val on val.idIngreso = ing.id
inner join nit on nit.id = ing.idNit
and inv.tipo like 'af'


END


GO
/****** Object:  StoredProcedure [dbo].[spConsultaUbica]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spConsultaUbica]
@idDetalle int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT ub.pasY AS 'pasillo', ub.ColX AS 'columna' FROM detalleDeMercaderia dtM
INNER JOIN incidencia inci ON inci.idDetalle = dtM.id
INNER JOIN ubicaciones ub ON ub.idIncidencia = inci.id AND ub.estado = 1 AND dtM.id = @idDetalle

END
GO
/****** Object:  StoredProcedure [dbo].[spConsulTipoConsol]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spConsulTipoConsol]
@Iding int
	AS
BEGIN
	SET NOCOUNT ON;


SELECT consolidado FROM ingresoOperacionFiscal WHERE id = @Iding

		  



END



GO
/****** Object:  StoredProcedure [dbo].[spConsultNav]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spConsultNav]

@valor int,
@depe int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT TOP(1) bod.id AS 'idDeBodega',ep.empresa AS 'nomEmpresa', bod.AreasAutorizadas AS 'Areas', bod.numeroIdentidad AS 'numBod' 
From navegacion nav 
INNER JOIN BODEGAS bod ON nav.idArea = bod.id  AND nav.idUsuario = @valor
INNER JOIN EMPRESAS ep ON bod.dependencia = ep.id AND  ep.id=@depe
ORDER BY nav.fechaNavega DESC
	


END


GO
/****** Object:  StoredProcedure [dbo].[spConsultPlt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spConsultPlt]

AS
BEGIN
	SET NOCOUNT ON;

SELECT ing.id, ing.numeroPoliza, val.fechaRealIng, plt.licencia, plt.piloto, plc.placa, cont.contenedor,
nit.nombreEmpresa, nit.nitEmpresa, ing.familiaPoliza,
 regimen.regimen, regimen.familia 
FROM datosUnidades dtU

left join ingresoOperacionFiscal ing on ing.id = dtU.idOp

inner join valoresIngOpFiscal val on val.idIngreso = ing.id
inner join regimen on regimen.id = ing.regimen 
left join pilotos plt on plt.id = dtU.piloto
left join unidadesPlacas plc on plc.id = dtU.unidadPlaca
left join unidadesContenedores cont on cont.id = dtU.unidadContenedor
inner join nit on nit.id = ing.idNit
where dtU.tipoOp = 1
order by val.fechaRealIng asc, ing.id
END


GO
/****** Object:  StoredProcedure [dbo].[spConsultReg]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spConsultReg]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM REGIMEN WHERE id = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spConsultRetDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spConsultRetDet]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT detallesRebajados FROM retiroOperacionFiscal WHERE id = @valor




END


GO
/****** Object:  StoredProcedure [dbo].[spContabilidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spContabilidad]
@tipo int
	AS
BEGIN
	SET NOCOUNT ON;
IF (@tipo=0)
BEGIN
SELECT
ISNULL(ROUND(SUM(valIng.totalValorCif),2),0) AS 'totalCifIngMerca', 
ISNULL(ROUND(SUM(valIng.valorImpuesto),2),0) AS 'totalImpuestoIngMerca'
FROM ingresoOperacionFiscal ingOp
INNER JOIN valoresIngOpFiscal valIng ON valIng.idIngreso = ingOp.id AND ingOp.estadoIngreso = 5 
END
IF (@tipo=1)
BEGIN
SELECT 
ISNULL(ROUND(SUM(valRet.totalValorCif),2),0) AS 'totalCifRetMerca', 
ISNULL(ROUND(SUM(valRet.valorImpuesto),2),0) AS 'totalImpuestoRetMerca'
FROM retiroOperacionFiscal retOP
INNER JOIN valoresRetirosFiscal valRet ON valRet.idRet = retOP.id AND retOP.estadoRet = 4
END
END

GO
/****** Object:  StoredProcedure [dbo].[spContabilizaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spContabilizaIng]
	@ident int,
	@fecha date

AS
BEGIN
	SET NOCOUNT ON;

UPDATE ingresoOperacionFiscal
SET fechaContabilidad = @fecha, estadoIngreso = estadoIngreso+1
WHERE estadoIngreso = 5 AND identBodega = @ident

END


GO
/****** Object:  StoredProcedure [dbo].[spContabilizaLoteIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spContabilizaLoteIng]
@ident int,
@fecha date


	AS
BEGIN
	SET NOCOUNT ON;

UPDATE ingresoOperacionFiscal
SET fechaContabilidad = @fecha, estadoIngreso = estadoIngreso+1
WHERE estadoIngreso = 5 AND identBodega = @ident


END


GO
/****** Object:  StoredProcedure [dbo].[spContabilizaRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spContabilizaRet]
	@ident int,
	@fecha date

AS
BEGIN
	SET NOCOUNT ON;

UPDATE retiroOperacionFiscal
SET fechaConta = @fecha, estadoRet = 6
WHERE estadoRet = 5 AND idDependencia = @ident

UPDATE trasladoFiscalVeh
SET estado = 3, fechaContabilidad = @fecha
WHERE estado = 2

update chasisVehiculosNuevos
set estado = 4
from trasladoFiscalVeh tras
inner join chasisVehiculosNuevos chas on chas.id = tras.chasis and tras.estado = 2

END


GO
/****** Object:  StoredProcedure [dbo].[spContabilizaVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spContabilizaVeh]
@idTras int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN trasVehConta

DECLARE @idChas INT
SET @idChas = (SELECT chasis FROM trasladoFiscalVeh WHERE id = @idTras)

UPDATE trasladoFiscalVeh
SET estado = 2, fechaContabilidad = GETDATE()
WHERE id = @idTras

UPDATE chasisVehiculosNuevos SET estado = 3 WHERE id = @idChas
SET @error = @@ERROR

IF(@error!=0)
BEGIN
ROLLBACK TRAN trasVehConta
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN trasVehConta
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spContaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spContaIng]
@idIng int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int

declare @proximo_numero int 
DECLARE @idIdenty INT
SET @idIdenty = (SELECT identBodega FROM ingresoOperacionFiscal WHERE id = @idIng)

DECLARE @revision INT
SET @revision = (SELECT ISNULL(COUNT(*),0) FROM numAsignadoIngresos where idIng = @idIng AND idIdent = @idIdenty)


	IF (@revision=0)
	BEGIN
	begin tran transOp
		
		DECLARE @categoriaCount INT
		SET @categoriaCount = (SELECT count(*) FROM vinculosDeBodegas WHERE idBodega = @idIdenty)
		IF (@categoriaCount=0)
		BEGIN
			INSERT vinculosDeBodegas VALUES ((SELECT numeroIdentidad FROM bodegas WHERE id = @idIdenty), @idIdenty)
			UPDATE bodegas SET idVinculo = @@IDENTITY 
		END



		DECLARE @categoria INT
		SET @categoria = (SELECT ISNULL(id, 0) FROM vinculosDeBodegas WHERE idBodega = @idIdenty)

		DECLARE @ingNombreCorrtivo INT
		SET @ingNombreCorrtivo = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'INGRESO') 
		/*ver si existe el ingreso*/
		DECLARE @estadoCorrelativo int
		SET @estadoCorrelativo = (SELECT ISNULL(COUNT(*),0) FROM numeradorCorrelativos WHERE idCategoria = @categoria AND idnomCorrelativo = @ingNombreCorrtivo)

	IF (@estadoCorrelativo=0)
	BEGIN 
		EXECUTE spInicioNumerador @categoria, @ingNombreCorrtivo, 0
	END


		DECLARE @error1 int
		update numeradorCorrelativos set @proximo_numero = ultimoNumero = ultimoNumero + 1
		where idCategoria =  @categoria AND idnomCorrelativo = @ingNombreCorrtivo

		INSERT INTO numAsignadoIngresos VALUES (@idIng, @idIdenty, @proximo_numero, getdate())
		update inventarioFiscal set fechaReporte = getdate() where id = @idIng

		SET @error1 = @@ERROR
	IF	(@error1<>0)
	BEGIN
		ROLLBACK TRAN transOp	
				SELECT 0 AS 'estadoTran'
	END
	ELSE
	BEGIN
		COMMIT TRAN transOp
		SELECT 1 AS 'estadoTran'
	END
	END
	END
	

GO
/****** Object:  StoredProcedure [dbo].[spContaIngresoEstado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spContaIngresoEstado]
@idIngreso int,
@fechaConta datetime,
@usuario int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranConta

DECLARE @estado int
SET @estado = (SELECT estadoIngreso FROM ingresoOperacionFiscal WHERE id = @idIngreso)
IF (@estado=4)
begin
UPDATE ingresoOperacionFiscal
SET estadoIngreso = estadoIngreso+1, fechaContabilidad = @fechaConta
WHERE id = @idIngreso



EXECUTE spBitacoraIng @idIngreso, 'Ingreso Contabilizado', @usuario, 0

IF (@error<>0)
BEGIN
ROLLBACK TRAN tranConta
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranConta
SELECT 1 'resp'
END
end

END
GO
/****** Object:  StoredProcedure [dbo].[spContaRetiro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spContaRetiro]
	@idIRet int,
	@tipo int, 
	@idUsuario int,
	@date date

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranContaRet
IF (@tipo = 0)
BEGIN

DECLARE @time DATETIME
SET @time = GETDATE();

UPDATE retiroOperacionFiscal
SET estadoRet = estadoRet+1, fechaConta = @date 
WHERE id = @idIRet
	
DECLARE @idIngreso INT
SET @idIngreso = (SELECT idIngresosOP FROM retiroOperacionFiscal WHERE id = @idIRet)
DECLARE @countIngDet INT
SET @countIngDet = (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso = @idIngreso and stock = 0)
DECLARE @countRet INT
SET @countRet = (SELECT COUNT(*) FROM retiroOperacionFiscal WHERE idIngresosOP = @idIngreso AND estadoRet = 5)

IF (@countRet=@countIngDet)
BEGIN
UPDATE inventarioFiscal
SET fechaReporte = @date
WHERE idIngreso = @idIngreso
END


EXECUTE spBitacoraRet @idIRet, 'Retiro Contabilizado', @idUsuario, 0, @time 
END

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranContaRet
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranContaRet
SELECT 1 AS 'resp'
END
END


GO
/****** Object:  StoredProcedure [dbo].[spContaVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spContaVeh]
@estado int,
@bodega int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @bodega)


SELECT 
round(SUM(tras.cif),2) AS 'cif', ROUND(SUM(tras.impuesto),2) AS 'impuesto', @dependencia as 'dependencia'
FROM trasladoFiscalVeh tras
inner join retiroOperacionFiscal ret ON ret.id = tras.idRet
inner join ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP 
inner join bodegas bod on bod.id = ing.identBodega and bod.dependencia = @dependencia
and tras.estado = @estado


END


GO
/****** Object:  StoredProcedure [dbo].[spContaVehEstado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spContaVehEstado]
@estado int,
@bodega int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @bodega)


update trasladoFiscalVeh set estado = 3
FROM trasladoFiscalVeh tras
inner join retiroOperacionFiscal ret ON ret.id = tras.idRet
inner join ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP 
inner join bodegas bod on bod.id = ing.identBodega and bod.dependencia = @dependencia
and tras.estado = @estado


END


GO
/****** Object:  StoredProcedure [dbo].[spCorreoPrepara]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spCorreoPrepara]

	@idTrasChasis int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
DECLARE @fecha DATETIME
SET @fecha = GETDATE()
BEGIN TRAN transCorreo
UPDATE trasladoFiscalVeh
set estado = 1, fechaCorreo = @fecha
WHERE id  = @idTrasChasis

IF (@error!=0)
BEGIN
ROLLBACK TRAN transCorreo
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN transCorreo
SELECT 1 'resp'
END


END
GO
/****** Object:  StoredProcedure [dbo].[spCortesRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spCortesRet]
@idIng int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT TOP 1 convert(varchar(12),corte,105) AS 'Fcorte' FROM CORTERECIBO WHERE idIngreso = @idIng
ORDER BY corte DESC
END
GO
/****** Object:  StoredProcedure [dbo].[spCountChas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spCountChas]
@idIng int
	AS
BEGIN
	SET NOCOUNT ON;

select COUNT(*) AS 'countChas' from chasisVehiculosNuevos where idIngreso = @idIng

END


GO
/****** Object:  StoredProcedure [dbo].[spCreaInventario]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spCreaInventario]
@valIngreso int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @bultos int
SET @bultos	= (SELECT bultos FROM valoresIngOpFiscal where id=@valIngreso)

DECLARE @valorTotalAduana float
SET @valorTotalAduana = (SELECT valorTotalAduana FROM valoresIngOpFiscal where id=@valIngreso)

DECLARE @totalValorCif float
SET @totalValorCif = (SELECT totalValorCif FROM valoresIngOpFiscal where id=@valIngreso)

DECLARE @valorImpuesto float
SET @valorImpuesto = (SELECT valorImpuesto FROM valoresIngOpFiscal where id=@valIngreso)

DECLARE @pesoKg float
SET @pesoKg  = (SELECT peso FROM valoresIngOpFiscal where id=@valIngreso)

INSERT INTO [dbo].[inventarioFiscal]
           ([idIngreso]
           ,[saldoBultos]
		   ,[pesoKg]
           ,[saldoValorTAduana]
           ,[saldoValorCif]
           ,[saldoValorImpuesto])
     VALUES
           (@valIngreso
           ,@bultos
		   ,@pesoKg
           ,@valorTotalAduana
           ,@totalValorCif
           ,@valorImpuesto)



END


GO
/****** Object:  StoredProcedure [dbo].[spCreaNewEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spCreaNewEmpresa]
@nombreEmpresa text

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN newEmpresaVeh
DECLARE @revision INT
SET @revision = (SELECT COUNT(*) FROM grupoEmpresas WHERE nombreEmpresa LIKE @nombreEmpresa)
IF (@revision=0)
BEGIN
INSERT INTO [dbo].[grupoEmpresas]
           ([nombreEmpresa])
     VALUES
           (@nombreEmpresa)

END
END


SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN newEmpresaVeh
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN newEmpresaVeh
SELECT @revision 'resp'
END


GO
/****** Object:  StoredProcedure [dbo].[spCrearVisita]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spCrearVisita]
@licVisita text,
@personaVisita text,
@idPlaca int,
@idArea int,
@idEmpresa int,
@gafete int,
@idBodega int,
@idUsuario int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranCreaVisita
DECLARE @lic INT
SET @lic = (SELECT ISNULL(COUNT(*),0) FROM personalVisitas WHERE licDoc LIKE @licVisita)

IF (@lic=0)
BEGIN
INSERT INTO [dbo].[personalVisitas] ([licDoc], [nombreApellido]) VALUES (@licVisita, @personaVisita)
END

DECLARE @idLic INT
SET @idLic = (SELECT id FROM personalVisitas WHERE licDoc LIKE @licVisita)
DECLARE @empresaUsuario INT
DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)

INSERT INTO [dbo].[visitasAlmacenadoraIntegrada]
           ([idPiloto]
           ,[idPlaca]
           ,[idAreaVisita]
           ,[idEmpresaVisita]
           ,[NoGafete]
           ,[fechaIngreso]
           ,[estado]
           ,[usuario]
           ,[empresa])
     VALUES
           (@idLic
           ,@idPlaca
           ,@idArea
           ,@idEmpresa
           ,@gafete
           ,GETDATE()
           ,1
           ,@idUsuario
           ,@dependencia)
	

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranCreaVisita
SELECT 0 'resp'
END
COMMIT TRAN tranCreaVisita
SELECT 0 'resp'

END


GO
/****** Object:  StoredProcedure [dbo].[spCreateCont]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spCreateCont]
	@contenedor text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranCont
INSERT INTO [dbo].[unidadesContenedores]
           ([contenedor])
     VALUES
           (@contenedor)

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranCont
END
ELSE
BEGIN
COMMIT TRAN tranCont
END



END


GO
/****** Object:  StoredProcedure [dbo].[spCreatePlaca]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spCreatePlaca]
	@placa text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranPlaca
INSERT INTO [dbo].[unidadesPlacas]
           ([placa])
     VALUES
           (@placa)

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranPlaca
END
ELSE
BEGIN
COMMIT TRAN tranPlaca
END



END


GO
/****** Object:  StoredProcedure [dbo].[spCtrPendDia]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spCtrPendDia]
	@idEmpresa int

AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @depe INT
	SET @depe = (SELECT dependencia FROM bodegas WHERE id = @idEmpresa)

SELECT DISTINCT (convert(varchar, fecha, 23)) AS 'fechaPendiente'
FROM correaltivoPoliza
INNER JOIN polizasContaFiscal ON polizasContaFiscal.numeroPoliza = correaltivoPoliza.numero AND polizasContaFiscal.idEmpresa = @depe 
AND correaltivoPoliza.estado = 0




END


GO
/****** Object:  StoredProcedure [dbo].[spCuentasContables]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spCuentasContables]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM cuentasContables


END


GO
/****** Object:  StoredProcedure [dbo].[spDataCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spDataCalculo]

	@idIng int
	

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idNit int
SET @idNit = (SELECT idNit FROM ingresoOperacionFiscal WHERE id = @idIng)

DECLARE @idNitChar varchar(10)
SET @idNitChar = (CAST(@idNit AS varchar(10)))
SELECT 

PeriodoAlmacenaje,
tarifaAlmacenaje,
minimoAlmacenaje,

PeriodoZonaAduanera,
tarifaZonaAduanera,
minimoZonaAduanera,

baseManejo,
tarifaManejo,
minimoManejo,
reglaAproximacion,

minGastosAdministracion,
tarifaGastosAdministrativos,
tarifaFotocopias,
convert(varchar(12),fechaVencimiento,105) AS 'fechaVencimiento',
delAlmacenaje,
alAlmacenaje,
delZA,
Tipo_Direccion			

FROM tarifasNormales WHERE Dependencia_Nit like @idNitChar
END
GO
/****** Object:  StoredProcedure [dbo].[spDataCalculoNormal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spDataCalculoNormal]

	@idFamType int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @familia varchar(10)
SET @familia = (CAST(@idFamType AS varchar(10)))
SELECT 

PeriodoAlmacenaje,
tarifaAlmacenaje,
minimoAlmacenaje,

PeriodoZonaAduanera,
tarifaZonaAduanera,
minimoZonaAduanera,

baseManejo,
tarifaManejo,
minimoManejo,

minGastosAdministracion,
tarifaGastosAdministrativos,
tarifaFotocopias,
convert(varchar(12),fechaVencimiento,105) AS 'fechaVencimiento',
delAlmacenaje,
alAlmacenaje,
delZA,
Tipo_Direccion,
marchamoElectronico
,aplicaMarchamoElec
,minimoMarch,
convert(varchar(12), apartirFecha,105) as 'apartirFecha'

FROM tarifasNormales WHERE Regimen_Nit like @familia
END


GO
/****** Object:  StoredProcedure [dbo].[spDataClientes]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDataClientes]
@idNit INT
	AS
BEGIN
	SET NOCOUNT ON;

SELECT contacto AS 'nombreContacto', telefono AS 'telefonoContacto', email AS 'CorreoContacto', ejecutivoVentas AS 'numEjecutivo', id AS 'numCliente', numeroTarifa AS 'numeroTarifa' FROM USUARIOSEXTERNOS WHERE idNit=@idNit 

  

END
GO
/****** Object:  StoredProcedure [dbo].[spDataEjecutivo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spDataEjecutivo]
@idUsuario INT
	AS
BEGIN
	SET NOCOUNT ON;

IF (SELECT COUNT(*)  FROM PERSONAL WHERE id=@idUsuario)=1    
    (SELECT nombres AS 'usuarioNom', apellidos AS 'usuarioAp', departamento AS 'depto', email AS 'correoEjecutivo', telefono AS 'telefonoEjecutivo'  FROM PERSONAL WHERE id=@idUsuario) 
	
ELSE  
       PRINT 'SD';
END
GO
/****** Object:  StoredProcedure [dbo].[spDataRecibo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDataRecibo]
@idRet INT

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @inicioCorr INT
SET @inicioCorr = (SELECT numeroInicio FROM inicioCorrelativos)

DECLARE @tipoOp INT
SET @tipoOp = ISNULL((SELECT id FROM nombreFormas WHERE nombreForma LIKE 'RECIBO'),0)

SELECT retOp.fechaEmision AS 'fechaEm', retOp.polizaRetiro AS 'polRetiro', ingOP.numeroPoliza AS 'polIng', nitIng.id AS 'idNitIng',
nitRet.id AS 'idNitRet', retOp.descripcion AS 'descProducto', valRet.totalValorCif AS 'valCif', valRet.valorImpuesto AS 'valImpuesto'/*,
dtUnRet.marchamo AS 'numMarchamo', pltrRet.piloto AS 'nombrePiloto', pltrRet.licencia AS 'licPiloto',
placaRet.placa AS 'placaUnidad', contenedorRet.contenedor AS 'contenedorUnidad', nitRet.nombreEmpresa AS 'nombreRet', 
nitRet.nitEmpresa AS 'nitEmpresa', nitIng.nombreEmpresa AS 'nombreIng', valRet.bultos AS 'bultosSalida'
, (@inicioCorr+numAsigna.numeroAsignado) AS 'numeroRetiro'*/
FROM retiroOperacionFiscal retOp

INNER JOIN valoresRetirosFiscal valRet ON retOp.id = valRet.idRet and retOp.id = @idRet
INNER JOIN nit nitRet ON nitRet.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOP ON ingOP.id = retOp.idIngresosOP
INNER JOIN nit nitIng ON nitIng.id = ingOP.idNit

END
GO
/****** Object:  StoredProcedure [dbo].[spDataRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDataRet]
@idRet INT

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @cantChas INT
SET @cantChas = (SELECT COUNT(*) FROM chasisVehiculosNuevos WHERE idRet = @idRet)
DECLARE @inicioCorr INT
SET @inicioCorr = (SELECT numeroInicio FROM inicioCorrelativos)

DECLARE @tipoOp INT
SET @tipoOp = ISNULL((SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RETIRO'),0)
	DECLARE @tipoOpRec INT
SET @tipoOpRec = ISNULL((SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RECIBO'),0)

DECLARE @retNum INT
SET @retNum = (SELECT numeroAsignado FROM numAsignadoRetiros WHERE idRet = @idRet)

DECLARE @retNumRc INT
SET @retNumRc = (SELECT numeroAsignado FROM numAsignadoRecibos WHERE idRet = @idRet)

DECLARE @sumNum INT
SET @sumNum = (@retNum+@inicioCorr)

DECLARE @sumNumRc INT
SET @sumNumRc = (@retNumRc+@inicioCorr)

SELECT 
retOp.fechaEmision AS 'fechaEm', retOp.polizaRetiro AS 'polRetiro', ingOP.numeroPoliza AS 'polIng', nitIng.id AS 'idNitIng',
nitRet.id AS 'idNitRet', retOp.descripcion AS 'descProducto', valRet.totalValorCif AS 'valCif', valRet.valorImpuesto AS 'valImpuesto',
dtUnRet.marchamo AS 'numMarchamo', pltrRet.piloto AS 'nombrePiloto', pltrRet.licencia AS 'licPiloto',
placaRet.placa AS 'placaUnidad', contenedorRet.contenedor AS 'contenedorUnidad', nitRet.nombreEmpresa AS 'nombreRet', nitRet.direccionEmpresa as 'direSal', 
nitRet.nitEmpresa AS 'nitEmpresa', nitIng.nombreEmpresa AS 'nombreIng', valRet.bultos AS 'bultosSalida', 
ISNULL(cbAlm.rubroAlmacenaje,0) AS 'cbAlmacenaje', 
ISNULL(cbZA.rubroZonaAduanera,0) AS 'cbZnaAduana',
ISNULL(cbAd.rubroGastosAdmin,0) AS 'cbGastosAdmin',
ISNULL(cbMa.rubrosManejos,0) AS 'cbManejo',
ISNULL(revIng.rubroRevision,0) AS 'cbrubroRevision',
ISNULL(cbMarc.rubrosMarchElect,0) AS 'rubrosMarchElect',
retOp.estadoRet,
numAsignaRec.fechaAsignado,

empre.nit as 'nitAlm', empre.direccion as 'direAlm', empre.telefono as 'telAlm', empre.email as 'emailAlm', empre.logo as 'logoAlm',

nitFact.nitEmpresa AS 'nitFact', nitFact.nombreEmpresa AS 'empresaFact', nitFact.direccionEmpresa AS 'direFact',
@cantChas AS 'cantChasN',
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-',  YEAR(numAsigna.fechaAsignado),'-',ISNULL(@sumNum,0))) as 'numeroRetiro',
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-',  YEAR(numAsigna.fechaAsignado),'-',ISNULL(@sumNumRc,0))) as 'numeroRecibo'



FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal valRet ON retOp.id = valRet.idRet and retOp.id = @idRet
INNER JOIN nit nitRet ON nitRet.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOP ON ingOP.id = retOp.idIngresosOP
INNER JOIN bodegas bod ON bod.id = ingOP.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
INNER JOIN nit nitIng ON nitIng.id = ingOP.idNit
LEFT JOIN datosUnidades dtUnRet ON dtUnRet.idOp = @idRet AND dtUnRet.tipoOp = @tipoOp
LEFT JOIN pilotos pltrRet ON pltrRet.id = dtUnRet.piloto
LEFT JOIN unidadesPlacas placaRet ON placaRet.id = dtUnRet.unidadPlaca
LEFT JOIN unidadesContenedores contenedorRet ON contenedorRet.id = dtUnRet.unidadContenedor
LEFT JOIN numAsignadoRetiros numAsigna ON numAsigna.idRet = @idRet AND ingOP.id = numAsigna.idIng AND numAsigna.idIdent = ingOP.identBodega
LEFT JOIN numAsignadoRecibos numAsignaRec ON numAsignaRec.idRet = @idRet AND ingOP.id = numAsignaRec.idIng AND numAsignaRec.idIdent = ingOP.identBodega
LEFT JOIN nit nitFact ON nitFact.id = numAsignaRec.idFact
LEFT JOIN cobrosAlmacenajes cbAlm ON cbAlm.idRetiro = retOp.id
LEFT JOIN cobrosZonaAduanera cbZA ON cbZA.idRetiro =  retOp.id
LEFT JOIN cobrosGastosAdmin cbAd ON cbAd.idRetiro =  retOp.id
LEFT JOIN cobrosManejo cbMa ON cbMa.idRetiro =  retOp.id 
LEFT JOIN cobrosRevisionIng revIng ON revIng.idRetiro =  retOp.id 
LEFT JOIN cobrosMarchElectro cbMarc ON cbMarc.idRetiro =  retOp.id 
END
GO
/****** Object:  StoredProcedure [dbo].[spDataRetBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spDataRetBod]
@valIdRet int
	AS
BEGIN
	SET NOCOUNT ON;



SELECT retOP.detallesRebajados
FROM retiroOperacionFiscal retOP WHERE retOP.id = @valIdRet

END
GO
/****** Object:  StoredProcedure [dbo].[spDataRetExcel]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spDataRetExcel]
@idRet INT

	AS
BEGIN
	SET NOCOUNT ON;


DECLARE @inicioCorr INT
SET @inicioCorr = (SELECT numeroInicio FROM inicioCorrelativos)

DECLARE @tipoOp INT
SET @tipoOp = ISNULL((SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RETIRO'),0)
	DECLARE @tipoOpRec INT
SET @tipoOpRec = ISNULL((SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RECIBO'),0)

SELECT ingOP.numeroPoliza AS 'POLIZA DE INGRESO', regimen.regimen AS 'REGIMEN', CONVERT(VARCHAR, retOp.fechaEmision, 23) AS 'FECHA EMISION',
retOp.polizaRetiro as 'POLIZA DE RET', valRet.valorTotalAduana AS 'VAL ADUANA', valRet.tipoCambio AS 'T. CAMBIO',
valRet.totalValorCif AS 'CIF', valRet.valorImpuesto AS 'IMPUESTOS', valRet.peso AS 'PESO KG', valRet.bultos AS 'BULTOS RET',

nitRet.nitEmpresa as 'NIT EMPRESA', nitRet.nombreEmpresa as 'NOMBRE EMPRESA', nitRet.direccionEmpresa AS 'DIRECCION',
pltrRet.piloto AS 'NOMBRE PILOTO', pltrRet.licencia AS 'LICENCIA', placaRet.placa AS 'PLACA', contenedorRet.contenedor AS 'UNIDAD',  
retOp.descripcion AS 'PRODUCTO',  CONCAT(personal.nombres, ' ' , personal.apellidos) AS 'ELABORADO', dtUnRet.marchamo AS 'MARCHAMO'

FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal valRet ON retOp.id = valRet.idRet and retOp.id = @idRet
INNER JOIN nit nitRet ON nitRet.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOP ON ingOP.id = retOp.idIngresosOP
LEFT JOIN regimen ON regimen.id = ingOP.regimen
INNER JOIN nit nitIng ON nitIng.id = ingOP.idNit
LEFT JOIN datosUnidades dtUnRet ON dtUnRet.idOp = @idRet AND dtUnRet.tipoOp = @tipoOp
LEFT JOIN pilotos pltrRet ON pltrRet.id = dtUnRet.piloto
LEFT JOIN unidadesPlacas placaRet ON placaRet.id = dtUnRet.unidadPlaca
LEFT JOIN unidadesContenedores contenedorRet ON contenedorRet.id = dtUnRet.unidadContenedor
LEFT JOIN personal ON personal.id = retOp.idUsuario
END
GO
/****** Object:  StoredProcedure [dbo].[spDatoPlt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDatoPlt]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT plt.piloto AS 'nombrePiloto', plt.licencia AS 'licPiloto' FROM PILOTO plt WHERE plt.idRetiro = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spDatosBodega]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDatosBodega]
@idIngFinalizado int,
@tipo int
	AS
BEGIN
	SET NOCOUNT ON;

IF (@tipo=1)
BEGIN
/*OPERACIONES*/
SELECT TOP (1) nombres, apellidos from bitacoraIngresos
INNER JOIN personal ON personal.id = bitacoraIngresos.idUsuario
WHERE transaccion LIKE 'Registrado Ingreso' AND idIngreso = @idIngFinalizado
END
ELSE
BEGIN
/*BODEGA*/
SELECT TOP (1) nombres, apellidos from bitacoraIngresos
INNER JOIN personal ON personal.id = bitacoraIngresos.idUsuario
WHERE transaccion LIKE 'Culminar Ingreso' AND idIngreso = @idIngFinalizado
END
END
GO
/****** Object:  StoredProcedure [dbo].[spDatosCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDatosCalc]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;



SELECT ing.id, ing.numeroPoliza, convert(varchar(10),sldf.fechaRealIng,105) AS 'fechaRealIng', 
ntIng.nombreEmpresa, ntIng.nitEmpresa, sldf.cantidadClientes,
reg.regimen, ing.familiaPoliza,
trN.PeriodoAlmacenaje,	trN.tarifaAlmacenaje,	trN.minimoAlmacenaje,	trN.delAlmacenaje,	
trN.alAlmacenaje,	trN.baseZonaAduanera,	trN.PeriodoZonaAduanera,	trN.tarifaZonaAduanera,
trN.minimoZonaAduanera,	trN.delZA,	trN.baseManejo,	trN.tarifaManejo,	trN.minimoManejo,	
trN.baseGastosAdmin,	trN.tarifaGastosAdministrativos,	trN.minGastosAdministracion,	
trN.baseGastosFotocopias,	trN.tarifaFotocopias,	trN.baseCalculoDescargaRevision,	
trN.calculoDescargaRevision,	trN.baseCalculoOtrosGastos,	trN.calculoOtrosGastos, convert(varchar(10),trN.fechaVencimiento,105) AS 'fechaReal'  

FROM INGOPERACION ing
INNER JOIN tarifasNormales trN ON ing.familiaPoliza LIKE trN.Regimen_Nit AND ing.id = @valor
INNER JOIN SALDOS_FISCAL sldf ON sldf.idIngreso = ing.id
INNER JOIN NIT ntIng ON ntIng.id = ing.idNit
INNER JOIN REGIMEN reg ON reg.id = ing.regimen 


END


GO
/****** Object:  StoredProcedure [dbo].[spDatosCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDatosCalculo]
@idIngreso int,
@idRetiro int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @servicio varchar(50)
SET @servicio = (select rg.familia from ingresoOperacionFiscal ing INNER JOIN regimen rg ON ing.id = @idIngreso AND ing.regimen = rg.id)

SELECT ingIng.numeroPoliza AS 'polizaIngreso', ingIng.regimen AS 'regPoliza', convert(varchar(12),sldIng.fechaRealIng,105) AS 'FecingAlmacen', sldIng.cantidadContenedores AS 'cantContenedores',
sldIng.cantidadClientes AS 'cantClientes', trN.baseAlmacenaje AS 'baseAlm', trN.PeriodoAlmacenaje AS 'peridoAlm', trN.tarifaAlmacenaje  AS 'TarifaAlm', trN.baseZonaAduanera  AS 'baseZA', trN.PeriodoZonaAduanera AS 'peridoZona',
trN.tarifaZonaAduanera  AS 'tarifaZA', trN.baseManejo  AS 'baseManejo', trN.tarifaManejo  AS 'tarifaManejo',
trN.baseGastosAdmin  AS 'baseGtsAdmin', trN.tarifaGastosAdministrativos  AS 'TarifaGtsAdmin', trN.baseGastosFotocopias AS 'baseCopias', trN.tarifaFotocopias AS 'TarifaCopias', trN.baseCalculoDescargaRevision AS 'baseRevision',
trN.calculoDescargaRevision  AS 'calculoDescarga', trN.baseCalculoOtrosGastos AS 'baseOtrosGsts', trN.calculoOtrosGastos  AS 'calcOtrosGsts',
convert(varchar(12),trN.fechaVencimiento,105) AS 'fechaVenc',
convert(varchar(12),retOp.fechaEmision,105) AS 'fechaRet', sdlRet.totalValorCif AS 'totalCif',
sdlRet.valorImpuesto AS 'valImpuesto', sdlRet.peso  AS 'valPeso', retOp.polizaRetiro AS 'polizaRet', retOp.id+1000 AS 'numRet',
nt.id AS 'idNitRet', nt.nombreEmpresa AS 'empresaRt', nt.direccionEmpresa AS 'direccREt', nt.nitEmpresa AS 'nitRet', srv.servicio AS 'servicioAlm', trN.delAlmacenaje AS 'delAlm'
, trN.alAlmacenaje AS 'alAlm', trN.delZA AS 'delZA', trN.minGastosAdministracion AS 'minGastosAdministracion', trN.minimoAlmacenaje, trN.minimoZonaAduanera, trN.minimoManejo, @servicio AS 'familiaPoliza',
trN.marchamoElectronico, trN.aplicaMarchamoElec, convert(varchar(12),trN.apartirFecha,105) AS 'apartirFecha', trN.minimoMarch
FROM ingresoOperacionFiscal ingIng
INNER JOIN valoresIngOpFiscal sldIng ON ingIng.id = sldIng.idIngreso
INNER JOIN retiroOperacionFiscal retOp ON retOp.idIngresosOP = ingIng.id AND retOp.id = @idRetiro
INNER JOIN valoresRetirosFiscal sdlRet ON  sdlRet.idRet = retOp.id
INNER JOIN tarifasNormales trN ON trN.Regimen_Nit LIKE @servicio

INNER JOIN NIT nt ON nt.id = retOp.idNit
INNER JOIN SERVICIOS srv ON srv.id = ingIng.idServicio


END
GO
/****** Object:  StoredProcedure [dbo].[spDatosCalculoIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spDatosCalculoIng]

	@ing int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @regimen varchar(10)
SET @regimen = (SELECT reg.regimen FROM ingresoOperacionFiscal ing INNER JOIN regimen reg ON ing.regimen = reg.id AND ing.id = 1)
select ingF.numeroPoliza, ingF.regimen, ingF.idUsuarioCliente, convert(varchar(12),valF.fechaRealIng,105) AS 'fechaRealIng',
valF.cantidadContenedores, valF.cantidadClientes, @regimen AS 'regimen', regimen.familia AS 'familiaPoliza', nt.nombreEmpresa, nt.nitEmpresa,valF.fechaRealIng as 'fecha'
FROM ingresoOperacionFiscal ingF
INNER JOIN valoresIngOpFiscal valF 
ON ingF.id = valF.idIngreso
AND ingF.id = @ing
INNER JOIN nit nt ON nt.id = ingF.idNit
INNER JOIN regimen ON regimen.id = ingF.regimen

END
	
GO
/****** Object:  StoredProcedure [dbo].[spDatosContabilidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDatosContabilidad]
@idBodega int
AS
BEGIN
	SET NOCOUNT ON;

SELECT empresas.empresa, bodegas.areasAutorizadas, bodegas.numeroIdentidad, bodegas.dependencia 
FROM saldoContable802103_0102 saldo0102
INNER JOIN empresas ON empresas.id = saldo0102.idEmpresa
INNER JOIN bodegas ON bodegas.id = @idBodega
END


GO
/****** Object:  StoredProcedure [dbo].[spDatosGeneralVisita]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDatosGeneralVisita]
	@empresaOrigen text,
	@destinoOrigen text,
	@placaVistante text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranVisita
DECLARE @empresa INT
SET @empresa = (SELECT ISNULL(COUNT(*),0) FROM procedenciaVisita WHERE empresa LIKE @empresaOrigen)
IF (@empresa=0)
BEGIN
INSERT INTO [dbo].[procedenciaVisita] ([empresa]) VALUES (@empresaOrigen)
END

DECLARE @areaVisita INT
SET @areaVisita = (SELECT ISNULL(COUNT(*),0) FROM areasVisitada WHERE empresaVisitada LIKE @destinoOrigen)
IF (@areaVisita=0)
BEGIN
INSERT INTO [dbo].[areasVisitada] ([empresaVisitada]) VALUES (@destinoOrigen)
END

DECLARE @placaVisita INT
SET @placaVisita = (SELECT ISNULL(COUNT(*),0) FROM placasVisita WHERE placa LIKE @placaVistante)
IF (@placaVisita=0)
BEGIN
INSERT INTO [dbo].[placasVisita] ([placa]) VALUES (@placaVistante)
END

DECLARE @idEmpresa INT
SET @idEmpresa = (SELECT id FROM procedenciaVisita WHERE empresa LIKE @empresaOrigen)

DECLARE @idAreaVisita INT
SET @idAreaVisita = (SELECT id FROM areasVisitada WHERE empresaVisitada LIKE @destinoOrigen)

DECLARE @idPlacaVisita INT
SET @idPlacaVisita = (SELECT id FROM placasVisita WHERE placa LIKE @placaVistante)

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranVisita
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranVisita
SELECT @idEmpresa AS 'idEmpresa', @idAreaVisita AS 'idAreaVisita', @idPlacaVisita AS 'placaVisita', 1 AS 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spDatosRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spDatosRet]
	@idRet int

	AS
BEGIN
	SET NOCOUNT ON;

select count(*) as 'cantidadPlt' from datosUnidades
where idOp = @idRet and tipoOp = 2

END


GO
/****** Object:  StoredProcedure [dbo].[spDatosRetOp]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spDatosRetOp]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

select ret.id, ing.id as'idIng', nitRet.nitEmpresa, nitRet.nombreEmpresa, nitRet.direccionEmpresa,
ret.polizaRetiro, ret.regimenSalida, valRet.valorTotalAduana, valRet.tipoCambio,
valRet.totalValorCif, valRet.valorImpuesto, valRet.peso, valRet.bultos,
ret.descripcion, ret.detallesRebajados, ret.estadoRet, ing.numeroPoliza,
(SELECT COUNT(*) from chasisVehiculosNuevos where idRet = @valor) AS 'countChas',
(SELECT COUNT(*) from vehiculosUsados vehUS where ing.id = vehUS.idIngreso) AS 'countChasUsados'
from retiroOperacionFiscal ret
INNER JOIN nit nitRet ON nitRet.id = ret.idNit 
INNER JOIN valoresRetirosFiscal valRet ON valRet.idRet = ret.id
INNER JOIN ingresoOperacionFiscal ing ON ing.id = ret.idIngresosOP

WHERE ret.id = @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spDatosSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spDatosSalida]
	@calculo int
AS
BEGIN
	SET NOCOUNT ON;


select convert(varchar(12),fechaParaCalculo,105) AS 'fechaCalculo', poliza, valorCif, valorImpuesto, pesoKG, cantidadBultos from calculosNormal
WHERE id = @calculo

END


GO
/****** Object:  StoredProcedure [dbo].[spDatoUnd]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDatoUnd]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT und.placa AS 'placa', und.contenedor AS 'numeroCont' FROM UNIDADES und WHERE und.idRetiro = @valor


END


GO
/****** Object:  StoredProcedure [dbo].[spDeleteArea]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spDeleteArea]


		@idArea int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT


BEGIN TRAN tranDeletArea

DELETE areasBodegas WHERE id = @idArea

SET @error= @@ERROR

IF (@error != 0)
BEGIN
ROLLBACK TRAN tranDeletArea
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranDeletArea
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spDeleteDetalleIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDeleteDetalleIng]

@iding int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
BEGIN TRAN tranDeleteDet
DELETE detalleDeMercaderia WHERE idIngreso = @iding

SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranDeleteDet
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranDeleteDet
SELECT 1 'resp'
END


END
GO
/****** Object:  StoredProcedure [dbo].[spDeleteFilaAlmacenaje]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDeleteFilaAlmacenaje]
	@nuevoDato int,
	@valor int

AS
BEGIN
	SET NOCOUNT ON;



UPDATE ALMACENAJES
SET aplicaServicio=@nuevoDato
WHERE idTarifa=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spDeleteFilaGtosAdmin]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDeleteFilaGtosAdmin]
	@nuevoDato int,
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

UPDATE GASTOS_ADMIN
SET aplicaServicio=@nuevoDato
WHERE idgastosAdmin=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spDeleteFilaManejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDeleteFilaManejo]
	@nuevoDato int,
	@valor int

AS
BEGIN
	SET NOCOUNT ON;
UPDATE MANEJO
SET aplicaServicio=@nuevoDato
WHERE idManejo=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spDeleteFilaOtrosGts]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDeleteFilaOtrosGts]
	@nuevoDato int,
	@valor int

AS
BEGIN
	SET NOCOUNT ON;
UPDATE OTROS_GASTOS
SET aplicaServicio=@nuevoDato
WHERE idotrosGastos=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spDeleteFilaSeguro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spDeleteFilaSeguro]
	@nuevoDato int,
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

	UPDATE SEGURO 
	SET aplicaServicio=@nuevoDato
	WHERE idSeguro=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spDepartamentos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDepartamentos]


AS
BEGIN
	SET NOCOUNT ON;

SELECT id AS 'identDep', departamentos AS 'dep' FROM departamentos

END


GO
/****** Object:  StoredProcedure [dbo].[spDesactivar]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDesactivar]
	@nuevoDato int,
	@idCliente int

AS
BEGIN
	SET NOCOUNT ON;

	UPDATE USUARIOSEXTERNOS
	SET estadoTarifa=@nuevoDato
	WHERE id=@idCliente

END


GO
/****** Object:  StoredProcedure [dbo].[spDescExcelIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDescExcelIng]
	@idBod int,
	@estado int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idEmpresa int
SET @idEmpresa = (select empresas.id as 'idEmpresa' from bodegas INNER JOIN empresas ON empresas.id = bodegas.dependencia AND bodegas.id = @idBod)

SELECT nt.nitEmpresa AS 'NIT', nt.nombreEmpresa AS 'EMPRESA', ingOp.numeroPoliza AS 'POLIZA'
, valIng.bultos AS 'BULTOS ING'
, valIng.totalValorCif AS 'CIF', valIng.tipoCambio, valIng.valorImpuesto AS 'IMPUESTO', bodegas.numeroIdentidad AS 'BODEGA', valIng.cantidadClientes AS 'CLIENTES', valIng.cantidadContenedores AS 'CONTENEDORES', 
invent.saldoBultos AS 'SALDO BULTOS', invent.saldoValorCif AS 'SALDO CIF', invent.saldoValorImpuesto AS 'SALDO IMPUESTOS', convert(varchar, ingOp.fechaRegistro, 103)  AS 'FECHA EMISION DOC', convert(varchar, valIng.fechaRealIng, 103) AS 'FECHA REAL INGRESO'
  FROM ingresoOperacionFiscal ingOp
INNER JOIN inventarioFiscal invent ON invent.idIngreso = ingOp.id AND ingOp.estadoIngreso = @estado
INNER JOIN valoresIngOpFiscal valIng ON valIng.idIngreso = ingOp.id
INNER JOIN bodegas ON bodegas.dependencia = @idEmpresa and ingOp.identBodega = bodegas.numeroIdentidad
INNER JOIN nit nt  ON nt.id = ingOp.idNit 

END


GO
/****** Object:  StoredProcedure [dbo].[spDescontabiliza]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDescontabiliza]
	@idRet int,
	@usuario int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN transDescontabiliza
UPDATE retiroOperacionFiscal
SET fechaConta = NULL, estadoRet = estadoRet-1
WHERE id = @idRet
DECLARE @dateTime DATETIME
SET @dateTime = GETDATE()
EXECUTE spBitacoraRet @idRet, 'Descontabilizar Retiro', @usuario, 0, @dateTime
SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN transDescontabiliza
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN transDescontabiliza
SELECT 1 'resp'END

END


GO
/****** Object:  StoredProcedure [dbo].[spDescontabilizaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spDescontabilizaIng]
	@idIng int,
	@idUsuario int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranIngDesconta
UPDATE ingresoOperacionFiscal
SET fechaContabilidad = NULL, estadoIngreso = estadoIngreso-1
WHERE id = @idIng
EXECUTE spBitacoraIng @idIng, 'Ingreso Descontabilizado', @idUsuario, 0
SET @error = @@ERROR

IF (@error<>0)
BEGIN
ROLLBACK TRAN tranIngDesconta
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranIngDesconta
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spDescuentoOtro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDescuentoOtro]
@idCalculo int,
@descuento float,
@descuentoPercent float,
@fechaRegistro datetime,
@estado int,
@tipoOp int,
@idRet int


AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranDescuento 
INSERT INTO [dbo].[descuentosCalculos]
           ([idCalculo]
           ,[descuento]
           ,[descuentoPercent]
           ,[fechaRegistro]
           ,[estado]
           ,[tipoOp])
     VALUES
           (@idCalculo
           ,@descuento
           ,@descuentoPercent
           ,@fechaRegistro
           ,@estado
           ,@tipoOp)

DECLARE @identNewSer INT
SET @identNewSer = @@IDENTITY
IF (@idRet>=1 AND @estado=2)
BEGIN
DECLARE @valida INT
SET @valida = (SELECT ISNULL(COUNT(*),0) FROM otrosServiciosDescuentos WHERE idOperacion = @identNewSer AND tipoOp = 0)
IF (@valida=0)
BEGIN
INSERT INTO [dbo].[otrosServiciosDescuentos]
           ([idRet]
           ,[idOperacion]
           ,[tipoOp]
           ,[fechaEmision])
     VALUES
           (@idRet
           ,@identNewSer
           ,0
           ,GETDATE())
END
END

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranDescuento 
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranDescuento 
SELECT 1 AS 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spDetalleDeBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDetalleDeBod]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;
SELECT det.id, ing.numeroPoliza, det.empresa, det.stock FROM detalleDeMercaderia det
INNER JOIN ingresoOperacionFiscal ing ON ing.id = det.idIngreso and det.id = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spDetalleIngreso]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spDetalleIngreso]
	@idIng int


AS
BEGIN
	SET NOCOUNT ON;

SELECT ing.id AS 'idIng',nt.nombreEmpresa AS 'consolidado', detM.id AS 'idDet', detM.peso AS 'pesoKG', ing.numeroPoliza AS 'pol', detM.empresa AS 'empresa', detM.bultos AS 'bultos',
detM.peso AS 'peso', inci.descripcionMercaderia AS 'merca', inci.stockPos AS 'stockP', inci.stockMts AS 'stockM' FROM detalleDeMercaderia detM
INNER JOIN ingresoOperacionFiscal ing ON ing.id = detM.idIngreso AND ing.id = @idIng
INNER JOIN incidencia inci ON inci.idDetalle = detM.id AND inci.idIngreso = @idIng
INNER JOIN nit nt ON nt.id = ing.idNit
END


GO
/****** Object:  StoredProcedure [dbo].[spDetallesAjustInv]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spDetallesAjustInv]
@idBodega INT


	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

select detallesRebajados from retiroOperacionFiscal ret
INNER JOIN ingresoOperacionFiscal ing on ing.id = ret.idIngresosOP
INNER JOIN bodegas bod on bod.id = ing.identBodega and bod.dependencia = @dependencia

where estadoRet>=1 AND descripcion not like 'VEHICULOS NUEVOS'

END
GO
/****** Object:  StoredProcedure [dbo].[spDetallesEdit]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDetallesEdit]
@idIngreso int,
@tipo int

	AS
BEGIN
	SET NOCOUNT ON;
IF (@tipo)=1	
BEGIN
SELECT detM.id AS 'identi', detM.empresa AS 'nombreEmpresa', detM.bultos AS 'cantBultos', detM.peso AS 'cantPeso', detM.bultos AS 'cantBultos' FROM detalleDeMercaderia detM WHERE idIngreso = @idIngreso
END

END
GO
/****** Object:  StoredProcedure [dbo].[spDetallesRevision]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spDetallesRevision]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


DECLARE @idIng INT
SET @idIng= (SELECT idIngresosOP FROM retiroOperacionFiscal WHERE id = @valor)


SELECT detallesRebajados FROM retiroOperacionFiscal WHERE idIngresosOP = @idIng and estadoRet >=2
end




GO
/****** Object:  StoredProcedure [dbo].[spDetalleStock]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spDetalleStock]
@idDetalle int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT empresa, stock, bultos, peso, inc.stockPos, inc.stockMts, ing.numeroPoliza FROM detalleDeMercaderia detM
INNER JOIN incidencia inc ON detM.id = @idDetalle AND inc.idDetalle = detM.id
INNER JOIN ingresoOperacionFiscal ing ON ing.id = detM.idIngreso
END


GO
/****** Object:  StoredProcedure [dbo].[spDetalleStockPOSM]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spDetalleStockPOSM]
@idDetalle int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
posM.id as 'idPOSM',
detM.empresa, detM.stock, detM.bultos, detM.peso, inc.stockPos, inc.stockMts, ing.numeroPoliza, 
posM.stockPos as 'stockPOSM', posM.stockMetraje, area.nombreArea

FROM detalleDeMercaderia detM
INNER JOIN incidencia inc ON detM.id = @idDetalle AND inc.idDetalle = detM.id
INNER JOIN ingresoOperacionFiscal ing ON ing.id = detM.idIngreso
INNER JOIN posMetrajeBod posM ON posM.idIncidencia = inc.id
INNER JOIN areasBodegas area ON area.id = posM.idAreaBod

END


GO
/****** Object:  StoredProcedure [dbo].[spDetRetConta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spDetRetConta]
@ident int

AS
BEGIN
	SET NOCOUNT ON;

SELECT top(1) empresas.empresa, bodegas.areasAutorizadas, bodegas.numeroIdentidad 
FROM retiroOperacionFiscal retOP
INNER JOIN ingresoOperacionFiscal ingOp ON retOP.idIngresosOP = ingOp.id and ingOp.identBodega = @ident
INNER JOIN bodegas ON bodegas.numeroIdentidad = ingOp.identBodega
INNER JOIN empresas ON bodegas.dependencia = empresas.id
END


GO
/****** Object:  StoredProcedure [dbo].[spDetRetSal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDetRetSal]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;
   
SELECT ing.numeroPoliza AS 'polIng', retOp.polizaRetiro AS 'polRet', retOp.id+1000 AS 'numRet',
sdRet.valorTotalAduana AS 'valDoll', sdRet.totalValorCif AS 'cif', sdRet.valorImpuesto AS 'impts', 
sdRet.bultos AS 'cantBultos', sdRet.peso AS 'peso', sdRet.tipoCambio AS 'tCambio'

FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal sdRet ON sdRet.idRet =  retOp.id AND retOp.id = @valor
INNER JOIN ingresoOperacionFiscal ing	ON	ing.id = retOp.idIngresosOP


END


GO
/****** Object:  StoredProcedure [dbo].[spDibMapa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spDibMapa]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT area.pasY AS 'pasillos', area.colX AS 'columnas' FROM BODEGAS  bod
INNER JOIN MAPEOAREAS area ON area.idAreasAlmacenadoras = bod.id AND area.idAreasAlmacenadoras=@valor
END


GO
/****** Object:  StoredProcedure [dbo].[spDibMapaIn]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spDibMapaIn]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT inac.pasilloY, inac.columnaX FROM BODEGAS  bod
INNER JOIN MAPEOAREAS area ON area.idAreasAlmacenadoras = bod.id AND bod.id=@valor
INNER JOIN INACTIVOS inac ON bod.id = inac.idMapeoBodega




END


GO
/****** Object:  StoredProcedure [dbo].[spEdicionDetIndivi]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spEdicionDetIndivi]
@idIngreso int,
@bultos int,
@peso float

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @nombreEmpresa varchar(80)
SET @nombreEmpresa = (SELECT nt.nombreEmpresa from ingresoOperacionFiscal ingF INNER JOIN nit nt ON nt.id = ingF.idNit AND ingF.id = @idIngreso)

UPDATE detalleDeMercaderia
SET empresa = @nombreEmpresa, bultos = @bultos, peso = @peso, stock = @bultos  
WHERE idIngreso = @idIngreso

END

GO
/****** Object:  StoredProcedure [dbo].[spEdicionUbicacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spEdicionUbicacion]
@idDetalle int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idInci int
SET @idInci = (SELECT id FROM incidencia WHERE idDetalle = @idDetalle)
SELECT ub.pasY AS 'pasillo', ub.ColX AS 'columna', ing.identBodega AS 'idBodega' FROM ubicaciones ub 
INNER JOIN incidencia inci ON inci.id = ub.idIncidencia
INNER JOIN ingresoOperacionFiscal ing ON ing.id = inci.idIngreso AND ub.idIncidencia = @idInci AND ub.estado = 1

END
GO
/****** Object:  StoredProcedure [dbo].[spEdicionValRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spEdicionValRet]
@idIngreso int,
@idRet int,
@bultos int,
@peso float,
@tipoCambio float,
@valorTotalAduana float,
@totalValorCif float,
@valorImpuesto float

	AS
BEGIN
	SET NOCOUNT ON;


UPDATE [dbo].[valoresRetirosFiscal]
   SET [idIngreso] = @idIngreso
      ,[bultos] = @bultos
      ,[peso] = @peso
      ,[tipoCambio] = @tipoCambio
      ,[valorTotalAduana] = @valorTotalAduana
      ,[totalValorCif] = @totalValorCif
      ,[valorImpuesto] = @valorImpuesto
 WHERE idRet = @idRet


END


GO
/****** Object:  StoredProcedure [dbo].[spEditarBodInci]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spEditarBodInci]
@idDet int,
@posiciones int,
@metros float, 
@descripcion text

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @estado int
SET @estado = (SELECT estadoIncidencia FROM incidencia WHERE idDetalle = @idDet)
IF (@estado)=2
SELECT @estado AS 'tipoRes'
ELSE

UPDATE incidencia
SET posiciones = @posiciones, stockPos = @posiciones, metros = @metros, stockMts = @metros,
descripcionMercaderia = @descripcion
WHERE idDetalle = @idDet AND estadoIncidencia = 1

SELECT @estado AS 'tipoRes'



END
GO
/****** Object:  StoredProcedure [dbo].[spEditarEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spEditarEmpresa]
@nit text,
@empresa text,
@direccion text,
@telefono text, 
@email text,
@logo text,
@id int,
@establecimiento text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
BEGIN TRAN tranEditEmp
UPDATE empresas
SET nit = @nit, empresa = @empresa, direccion = @direccion, telefono = @telefono, email = @email, logo = @logo, establecimiento = @establecimiento
WHERE id =  @id

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranEditEmp
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranEditEmp
SELECT 1 'resp'
END
END


GO
/****** Object:  StoredProcedure [dbo].[spEditarGastosAdministracion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spEditarGastosAdministracion]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM GASTOS_ADMIN WHERE idgastosAdmin=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spEditarIngOP]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spEditarIngOP]
@indetyVal int,
@idCartaCupo text,
@numeroPoliza text,
@dua text,
@bl text,
@origenPuerto text,
@producto text,
@fechaRegistro date,
@idNit int,
@regimen int,
@consolidado int,
@idUsuarioCliente int



AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @familia int
	SET @familia = (SELECT id FROM REGIMEN WHERE id = @regimen)

UPDATE [dbo].[ingresoOperacionFiscal]
   SET [idCartaCupo] = @idCartaCupo
      ,[numeroPoliza] = @numeroPoliza
      ,[dua] = @dua
      ,[bl] = @bl
      ,[origenPuerto] = @origenPuerto
      ,[producto] = @producto

      ,[fechaRegistro] = @fechaRegistro
	  ,[idUsuarioCliente] = @idUsuarioCliente
      ,[idNit] = @idNit
	
      ,[regimen] = @regimen
      ,[familiaPoliza] = @familia	
	  ,[consolidado] = @consolidado

 WHERE id = @indetyVal
END


GO
/****** Object:  StoredProcedure [dbo].[spEditarIngreso]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spEditarIngreso]
@idIngreso int,
@idCartaCupo text,
@numeroPoliza text,
@dua text,
@bl text,
@origenPuerto text,
@producto text,
@idServicio int,
@regimen int

	AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @familia int
	SET @familia = (SELECT id FROM REGIMEN WHERE id = @regimen)
UPDATE [dbo].[ingresoOperacionFiscal]
   SET
       [idCartaCupo] = @idCartaCupo
      ,[numeroPoliza] = @numeroPoliza
      ,[dua] = @dua
      ,[bl] = @bl
      ,[origenPuerto] = @origenPuerto
      ,[producto] = @producto
      ,[idServicio] = @idServicio
      ,[regimen] = @regimen
      ,[familiaPoliza] = @familia
    WHERE id = @idIngreso
END


GO
/****** Object:  StoredProcedure [dbo].[spEditarInventario]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spEditarInventario]
	@bultos int,
	@peso float,
	@vTAduana float,
	@cif float,
	@impuesto float,
	@idIng int


AS
BEGIN
	SET NOCOUNT ON;

UPDATE inventarioFiscal
SET saldoBultos = @bultos, pesoKg=@peso, saldoValorTAduana = @vTAduana, saldoValorCif=@cif, saldoValorImpuesto = @impuesto
WHERE idIngreso = @idIng

END


GO
/****** Object:  StoredProcedure [dbo].[spEditarManejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spEditarManejo]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM MANEJO WHERE idManejo=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spEditarOtrosGastos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spEditarOtrosGastos]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM OTROS_GASTOS WHERE idotrosGastos=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spEditarPilotoAnt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spEditarPilotoAnt]

@licEdit text,
@nombreEdit text,
@numeroPlacaEdit text,
@numeroContEdit text,
@numeroMarchEdit text,
@hiddenIdentEdit int,
@hiddenTipEdit int,
@identiUnidad int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranEdit
DECLARE @idetLicPlt INT
SET @idetLicPlt = (SELECT piloto FROM datosUnidades WHERE id = @identiUnidad AND idOp = @hiddenIdentEdit AND tipoOp = @hiddenTipEdit)

DECLARE @idetPlacaUn INT
SET @idetPlacaUn = (SELECT unidadPlaca FROM datosUnidades WHERE id = @identiUnidad AND idOp = @hiddenIdentEdit AND tipoOp = @hiddenTipEdit)

DECLARE @idetContainer INT
SET @idetContainer = (SELECT unidadContenedor FROM datosUnidades WHERE id = @identiUnidad AND idOp = @hiddenIdentEdit AND tipoOp = @hiddenTipEdit)

UPDATE pilotos SET pilotos.licencia = @licEdit, pilotos.piloto = @nombreEdit WHERE pilotos.id = @idetLicPlt
UPDATE unidadesPlacas SET unidadesPlacas.placa = @numeroPlacaEdit WHERE unidadesPlacas.id = @idetPlacaUn
UPDATE unidadesContenedores SET unidadesContenedores.contenedor = @numeroContEdit WHERE unidadesContenedores.id = @idetContainer

SET @error = @@ERROR
IF	(@error<>0)
BEGIN
ROLLBACK TRAN tranEdit
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranEdit
SELECT 1 'resp'
END
END
GO
/****** Object:  StoredProcedure [dbo].[spEditarSaldoOp]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spEditarSaldoOp]
@idIngreso int,
@cantidadContenedores int,
@cantidadClientes int,
@peso float,
@bultos int,
@valorTotalAduana float,
@tipoCambio float,
@totalValorCif float,
@valorImpuesto float,
@fechaRealIng datetime
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranValores

UPDATE [dbo].[valoresIngOpFiscal]
   SET [cantidadContenedores] = @cantidadContenedores
      ,[cantidadClientes] = @cantidadClientes
      ,[peso] = @peso
      ,[bultos] = @bultos
      ,[valorTotalAduana] = @valorTotalAduana
      ,[tipoCambio] = @tipoCambio
	  ,[totalValorCif] = @totalValorCif
      ,[valorImpuesto] = @valorImpuesto
      ,[fechaRealIng] = @fechaRealIng
WHERE idIngreso = @idIngreso

EXECUTE spEditarInventario @bultos, @peso, @valorTotalAduana, @totalValorCif, @valorImpuesto, @idIngreso

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranValores
END
ELSE
BEGIN
COMMIT TRAN tranValores
END
END






GO
/****** Object:  StoredProcedure [dbo].[spEditarSeguro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spEditarSeguro]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM SEGURO WHERE idSeguro=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spEditFechaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spEditFechaIng]
@valor varchar(30),
@idIng int
	AS
BEGIN
	SET NOCOUNT ON;

declare @cad varchar(30)
select @cad = @valor

select @cad = substring(@cad, 7, 4) + '/' + substring(@cad, 4, 2) + '/' + substring(@cad, 1, 2) + ' ' + substring(@cad, 11, 16)



update valoresIngOpFiscal set fechaRealIng = cast(@cad as datetime) where idIngreso = @idIng



END


GO
/****** Object:  StoredProcedure [dbo].[spEditIngOp]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spEditIngOp]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

	SELECT ingOp.id AS 'idIngreso', ingOp.idCartaCupo AS 'cCupo', sdlfOp.cantidadContenedores AS 'cantContenedores', ingOp.dua AS 'numDua', ingOp.bl 'BLEmbarque',
	ingOp.numeroPoliza AS 'numPoliza', sdlfOp.bultos AS 'bultos', ingOp.origenPuerto AS 'puertoOrigen', sdlfOp.cantidadClientes AS 'cantClientes',
	ingOp.producto AS 'tipoProducto', sdlfOp.peso AS 'cantPeso', sdlfOp.valorTotalAduana AS 'totalAduana',
	sdlfOp.tipoCambio AS 'tCambio', sdlfOp.totalValorCif AS 'valCif', sdlfOp.valorImpuesto AS 'valImpuesto',
	 ingOp.idServicio AS 'servicioIng',  FORMAT(CAST(sdlfOp.fechaRealIng AS datetime2), N'dd-MM-yyyy hh:mm tt') AS 'fechaRealFormat',
	reg.regimen AS 'reg', reg.familia AS 'familia', reg.id AS 'identReg'
	
	FROM ingresoOperacionFiscal ingOp
	INNER JOIN valoresIngOpFiscal sdlfOp ON ingOp.id = sdlfOp.idIngreso AND ingOp.id = @valor
	INNER JOIN REGIMEN reg ON reg.id = ingOp.regimen
	

END
GO
/****** Object:  StoredProcedure [dbo].[spEditMarchamoSal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spEditMarchamoSal]
@idUnidad INT,
@marchamo TEXT,
@estado int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranUpdateRet

	UPDATE datosUnidades
	SET marchamo = @marchamo, estado = @estado
	where id = @idUnidad

IF (@error<>0)
BEGIN
ROLLBACK TRAN tranUpdateRet
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranUpdateRet
SELECT 1 AS 'resp'
END

END
GO
/****** Object:  StoredProcedure [dbo].[spEditRetiros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spEditRetiros]
@idIngresosOP int,
@idNit int,
@polizaRetiro text,
@regimenSalida text,
@descripcion text,
@detallesRebajados text,
@fechaRetiro datetime,
@idRetiro int
	AS
BEGIN
	SET NOCOUNT ON;

UPDATE [dbo].[retiroOperacionFiscal]
   SET [idIngresosOP] = @idIngresosOP
      ,[idNit] = @idNit
      ,[polizaRetiro] = @polizaRetiro
      ,[regimenSalida] = @regimenSalida
      ,[descripcion] = @descripcion
      ,[detallesRebajados] = @detallesRebajados
      ,[fechaRetiro] = @fechaRetiro
 WHERE id = @idRetiro
  

END
GO
/****** Object:  StoredProcedure [dbo].[spEditRetirosVehEd]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spEditRetirosVehEd]
@idIngresosOP int,
@idNit int,
@polizaRetiro text,
@regimenSalida text,
@descripcion text,
@fechaRetiro datetime,
@idRetiro int
	AS
BEGIN
	SET NOCOUNT ON;

UPDATE [dbo].[retiroOperacionFiscal]
   SET [idIngresosOP] = @idIngresosOP
      ,[idNit] = @idNit
      ,[polizaRetiro] = @polizaRetiro
      ,[regimenSalida] = @regimenSalida
      ,[descripcion] = @descripcion
      ,[fechaRetiro] = @fechaRetiro
 WHERE id = @idRetiro
  

END
GO
/****** Object:  StoredProcedure [dbo].[spEditStockInci]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spEditStockInci]
	@idDetalle int,
	@valPosSalidaEdit int,
	@valMtsSalidaEdit float,
	@saldoPosAnt int,
	@saldoMtsAnt float


AS
BEGIN
	SET NOCOUNT ON;

DECLARE @stockPos int
SET @stockPos = (SELECT stockPos FROM incidencia WHERE idDetalle = @idDetalle)

DECLARE @stockMts float
SET @stockMts = (SELECT stockPos FROM incidencia WHERE idDetalle = @idDetalle)

DECLARE @anteriorStockPos int
DECLARE @anteriorStockMts float

SET @anteriorStockPos = (@stockPos+@saldoPosAnt)

SET @anteriorStockMts = (@stockMts+@saldoMtsAnt)

DECLARE @nuevoStockPos int
DECLARE @nuevoStockMts float

SET @nuevoStockPos = (@anteriorStockPos-@valPosSalidaEdit)

SET @nuevoStockMts = (@anteriorStockMts-@valMtsSalidaEdit)


UPDATE incidencia
SET stockPos = @nuevoStockPos, stockMts = @nuevoStockMts
WHERE idDetalle = @idDetalle



END


GO
/****** Object:  StoredProcedure [dbo].[spEditUbicaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spEditUbicaIng]
	@identNew int,
	@Ing int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
BEGIN TRAN editarUbicaBod
DECLARE @estadoIng INT
DECLARE @resp INT
SET @estadoIng = (SELECT estadoIngreso FROM ingresoOperacionFiscal WHERE id = @Ing)
IF (@estadoIng<=2)
BEGIN
UPDATE ingresoOperacionFiscal SET identBodega = @identNew WHERE id = @Ing
SET @resp = 1
END
ELSE
BEGIN
SET @resp = 2
END

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN editarUbicaBod
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN editarUbicaBod
SELECT @resp 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spEjecutivoCredito]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spEjecutivoCredito]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;
SELECT per.id AS 'identyEje', per.nombres AS 'nom', per.apellidos AS 'ape', per.telefono AS 'telefono' FROM USUARIOSEXTERNOS cliente 
INNER JOIN PERSONAL per ON cliente.idNit = @valor AND per.id = cliente.ejecutivoVentas
END
GO
/****** Object:  StoredProcedure [dbo].[spElimHist]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spElimHist]
@fecha datetime,
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

UPDATE HISTORIALING
SET fechaBod = @fecha,
estadoIngreso = 2,
comentarios = 'Culminado Bodega'
WHERE idOp=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spEliminarUbica]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spEliminarUbica]
	@idIncidencia int,
	@pasY int,
	@colX int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE ubicaciones
SET estado = 0
WHERE idIncidencia = @idIncidencia AND pasY = @pasY AND ColX = @colX 

END


GO
/****** Object:  StoredProcedure [dbo].[spEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spEmpresa]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


SELECT * FROM NIT WHERE id=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spEstadoCliente]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spEstadoCliente]
@idCliente int,
@estado int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT

BEGIN TRAN updatCliente
UPDATE usuariosExternos
SET estado = @estado
where id = @idCliente
	
SET @error = @@ERROR

IF (@error<>0)
BEGIN
ROLLBACK TRAN updatCliente
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN updatCliente
SELECT 1 AS 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spEstadoContaDia]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spEstadoContaDia]
	@fecha date,
	@estado int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
begin tran tranEstadConta
UPDATE correaltivoPoliza
SET estado = @estado
WHERE fecha like @fecha

set @error = @@ERROR
IF (@error!=0)
BEGIN 
ROLLBACK TRAN tranEstadConta
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranEstadConta
SELECT 1 'resp'
END

END
GO
/****** Object:  StoredProcedure [dbo].[spEstadoEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spEstadoEmpresa]
@estado int,
@idEmpresa int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranEstadoEmpresa
UPDATE empresas
SET estado = @estado
WHERE id = @idEmpresa
	
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranEstadoEmpresa
SELECT 0 'resp'
END

ELSE
BEGIN
COMMIT TRAN tranEstadoEmpresa
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spEstadoIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spEstadoIng]
	@idIng int,
	@user int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @countChas INT
SET @countChas = (SELECT COUNT(*) FROM chasisVehiculosNuevos WHERE idIngreso = @idIng)
DECLARE @bltsIng INT
SET @bltsIng = (SELECT bultos FROM valoresIngOpFiscal WHERE idIngreso = @idIng)
DECLARE @diferencia INT
SET @diferencia = (@countChas-@bltsIng)

EXECUTE spBitacoraIng @idIng, 'Culminar Ingreso', @user, 0

IF (@diferencia=0 AND (SELECT estadoIngreso FROM ingresoOperacionFiscal WHERE id=@idIng)=1)
BEGIN
DECLARE @error INT
BEGIN TRAN tranUpdateEstado
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranUpdateEstado
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranUpdateEstado
SELECT 1 AS 'resp'
END

END





END


GO
/****** Object:  StoredProcedure [dbo].[spEstadoIngRev]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spEstadoIngRev]
@idIng int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error int
BEGIN TRAN tranRevIng

DECLARE @unidades int
SET @unidades = (SELECT count(*) FROM datosUnidades WHERE idOp = @idIng and estado = 1 and tipoOp = 1)

DECLARE @contenedores int
SET @contenedores = (SELECT  cantidadContenedores FROM valoresIngOpFiscal WHERE idIngreso = @idIng)

DECLARE @inci int
SET @inci = (SELECT COUNT(*) FROM incidencia WHERE idIngreso = @idIng)

DECLARE @detalle  int
set @detalle = (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso = @idIng)




IF (@unidades=@contenedores AND @inci=@detalle)
BEGIN
UPDATE ingresoOperacionFiscal 
SET estadoIngreso = estadoIngreso+1
WHERE id = @idIng
END

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranRevIng
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranRevIng
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spEstadoPersonal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spEstadoPersonal]
@idCliente int,
@estado int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT

BEGIN TRAN updatCliente
UPDATE personal
SET estado = @estado
where id = @idCliente
	
SET @error = @@ERROR

IF (@error<>0)
BEGIN
ROLLBACK TRAN updatCliente
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN updatCliente
SELECT 1 AS 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spEstadoRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spEstadoRet]
	@valor int,
	@estado int,
	@asignar int,
	@idUsuario int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN estadoRetTran

DECLARE @asigNum int
SET @asigNum = (SELECT COUNT(*) FROM numAsignadoRetiros WHERE idRet = @valor)

DECLARE @countRet INT
SET @countRet = (SELECT ISNULL(COUNT(*),0) from datosUnidades where idOp = @valor AND tipoOp = 2)


IF (@countRet>=1)
BEGIN
	IF (@asignar=0)
	BEGIN
	UPDATE retiroOperacionFiscal
		SET retiroOperacionFiscal.estadoRet = retiroOperacionFiscal.estadoRet+1
	WHERE id = @valor
	END

	IF (@asignar=1)
	BEGIN
		DECLARE @inicioCor INT
		SET @inicioCor = (SELECT numeroInicio FROM inicioCorrelativos)
		DECLARE @estadoRetAs INT
		SET @estadoRetAs  = (SELECT estadoRet FROM retiroOperacionFiscal WHERE id = 3583)
		
		DECLARE @idIng INT
		SET @idIng = (SELECT ing.id FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @valor)
		DECLARE @idIdenty INT
		SET @idIdenty = (SELECT ing.identBodega FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @valor)

	IF (@asigNum=0)
	BEGIN
	IF (@estadoRetAs=2 OR @estadoRetAs=3)
	BEGIN
		UPDATE retiroOperacionFiscal
		SET retiroOperacionFiscal.estadoRet = retiroOperacionFiscal.estadoRet+1
		WHERE id = @valor
		DECLARE @fecha datetime
		SET @fecha = (SELECT fechaEmision FROM retiroOperacionFiscal WHERE id = @valor)
	END
		/*ASIGNANDO NUMERO DE EN CORRELATIVO DE RETIROS*/
		/*SABER SI EXISTE UN CORRELATIVO*/
			DECLARE @proximo_numero INT
			DECLARE @categoria INT
			SET @categoria = (SELECT id FROM vinculosDeBodegas WHERE idBodega = @idIdenty)
			DECLARE @idNombreCorrel INT
			SET @idNombreCorrel = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RETIRO')
			DECLARE @estdCorrelativo INT
			SET @estdCorrelativo = (SELECT COUNT(*) FROM numeradorCorrelativos WHERE idCategoria = @categoria AND idnomCorrelativo = @idNombreCorrel )
			/*LA FECHA ES UN PARAMETRO DE BITACORA, YA QUE SINO SE MANDA GENERA UN ERROR EL STORE PRODUCE*/
			EXECUTE spBitacoraRet @valor, 'Retiro Fiscal', @idUsuario,  1, @fecha;	

	IF (@estdCorrelativo=0)
	BEGIN
			EXECUTE spInicioNumerador @categoria, @idNombreCorrel, 0
	END
			UPDATE numeradorCorrelativos SET @proximo_numero = ultimoNumero = ultimoNumero + 1
			where idCategoria =  @categoria AND idnomCorrelativo = @idNombreCorrel
			INSERT INTO numAsignadoRetiros VALUES (@valor, @idIng, @idIdenty, @proximo_numero, getdate())

			/*FIN DE ASIGNACION DE RETIRO*/
			SET @error = @@ERROR
	

		
	END
	END
		END

		IF (@error<>0)	
	BEGIN
			ROLLBACK TRAN estadoRetTran
			SELECT 0 AS 'resp'		
	END
	ELSE
	BEGIN
			COMMIT TRAN estadoRetTran
			SELECT 1 AS 'resp'		
	END




END

GO
/****** Object:  StoredProcedure [dbo].[spEstadoRetVehN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spEstadoRetVehN]
	@valor int,
	@estado int,
	@asignar int,
	@idUsuario int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN estadoRetTran

DECLARE @asigNum int
SET @asigNum = (SELECT COUNT(*) FROM numAsignadoRetiros WHERE idRet = @valor)

	IF (@asignar=1 AND @asigNum=0)
	BEGIN
		DECLARE @inicioCor INT
		SET @inicioCor = (SELECT numeroInicio FROM inicioCorrelativos)
		DECLARE @estadoRetAs INT
		DECLARE @nuMostrar INT
		SET @estadoRetAs  = (SELECT estadoRet FROM retiroOperacionFiscal WHERE id = @valor)

		DECLARE @idIng INT
		SET @idIng = (SELECT ing.id FROM retiroOperacionFiscal ret 
		INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @valor)

		DECLARE @idIdenty INT
		SET @idIdenty = (SELECT ing.identBodega FROM retiroOperacionFiscal ret 
		INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @valor)

	IF (@estadoRetAs=1)
	BEGIN
		UPDATE retiroOperacionFiscal
		SET retiroOperacionFiscal.estadoRet = @estado
		WHERE id = @valor
		DECLARE @fecha datetime
		SET @fecha = (SELECT fechaEmision FROM retiroOperacionFiscal WHERE id = @valor)

		/*ASIGNANDO NUMERO DE EN CORRELATIVO DE RETIROS*/
		/*SABER SI EXISTE UN CORRELATIVO*/
			DECLARE @proximo_numero INT
			DECLARE @categoria INT
			SET @categoria = (SELECT id FROM vinculosDeBodegas WHERE idBodega = @idIdenty)
			DECLARE @idNombreCorrel INT
			SET @idNombreCorrel = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RETIRO')
			DECLARE @estdCorrelativo INT
			SET @estdCorrelativo = (SELECT COUNT(*) FROM numeradorCorrelativos WHERE idCategoria = @categoria AND idnomCorrelativo = @idNombreCorrel )
			/*LA FECHA ES UN PARAMETRO DE BITACORA, YA QUE SINO SE MANDA GENERA UN ERROR EL STORE PRODUCE*/
			EXECUTE spBitacoraRet @valor, 'Retiro Fiscal', @idUsuario,  1, @fecha;	

	IF (@estdCorrelativo=0)
	BEGIN
			EXECUTE spInicioNumerador @categoria, @idNombreCorrel, 0
	END
			UPDATE numeradorCorrelativos SET @proximo_numero = ultimoNumero = ultimoNumero + 1
			where idCategoria =  @categoria AND idnomCorrelativo = @idNombreCorrel
			INSERT INTO numAsignadoRetiros VALUES (@valor, @idIng, @idIdenty, @proximo_numero, getdate())

			/*FIN DE ASIGNACION DE RETIRO*/
			SET @error = @@ERROR
	

		
	END
	END

		IF (@error<>0)	
	BEGIN
			ROLLBACK TRAN estadoRetTran
			SELECT 0 AS 'resp'		
	END
	ELSE
	BEGIN
			COMMIT TRAN estadoRetTran
			SELECT 1 AS 'resp'		
	END

	END




GO
/****** Object:  StoredProcedure [dbo].[spEstadoTar]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spEstadoTar]
	@idRet int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idIng INT
SET @idIng = (SELECT idIngresosOP FROM retiroOperacionFiscal WHERE id = @idRet)

DECLARE @tarifaEspecial int
SET @tarifaEspecial = (SELECT ISNULL(COUNT(*),0) FROM ingresoOperacionFiscal ing INNER JOIN USUARIOSEXTERNOS usx ON ing.idUsuarioCliente = usx.id AND ing.id=@idIng)

DECLARE @revDR INT
SET @revDR = (SELECT ISNULL(COUNT(*),0) FROM valoresPolizaDR WHERE idRet = @idRet)

DECLARE @almFiscal INT
SET @almFiscal = (SELECT ISNULL(COUNT(*),0) FROM inventarioFiscal WHERE idIngreso = @idIng AND tipo IS NOT NULL)

IF (@tarifaEspecial>=1 OR @revDR>=1 OR @almFiscal>=1)
BEGIN
UPDATE retiroOperacionFiscal 
SET estadoRet = 4
WHERE id = @idRet
select  1 as 'resp'
END
ELSE
BEGIN
select  0 as 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spEstIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spEstIng]
@idIngreso int,
@estado int,
@idUsuario int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranEstadoIng

	UPDATE ingresoOperacionFiscal
	SET estadoIngreso = estadoIngreso+1
	WHERE id = @idIngreso

EXECUTE spBitacoraIng @idIngreso, 'Registrado Ingreso', @idUsuario, 0 
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranEstadoIng
SELECT 0 AS 'resp'
END
BEGIN
COMMIT TRAN tranEstadoIng
SELECT 1 AS 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spExcelVehNew]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spExcelVehNew]

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @inicio INT
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT 
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-',@inicio+numAsIng.numeroAsignado)) as 'Numero de Ingreso',

ing.numeroPoliza AS 'POLIZA NO.', regimen.regimen, nit.nitEmpresa AS 'NIT EMPRESA', nit.nombreEmpresa AS 'NOMBRE EMPRESA',
chas.chasis AS 'CHASIS', med.linea, tip.tipoVehiculo, prd.descripcion,
prd.predio, 
convert(varchar, val.fechaRealIng, 103)	as 'FECHA INGRESO'

FROM chasisVehiculosNuevos chas

INNER JOIN valoresIngOpFiscal val ON val.idIngreso = chas.idIngreso
INNER JOIN ingresoOperacionFiscal ing ON ing.id = chas.idIngreso
INNER JOIN regimen ON regimen.id = ing.regimen
INNER JOIN nit on nit.id = ing.idNit
left join numAsignadoIngresos numAsIng ON numAsIng.idIng = ing.id
INNER JOIN BODEGAS bod ON bod.id = ing.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
inner join medidasVehiculos med ON med.id = chas.lineaVehiculo
INNER JOIN prediosDeVehiculos prd ON prd.id = chas.ubicacion
inner join tiposDeVehiculos tip on tip.id  = chas.tipoVehiculo
ORDER BY numAsIng.numeroAsignado




END
GO
/****** Object:  StoredProcedure [dbo].[spFCambioDia]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spFCambioDia]
	@fecha date
AS
BEGIN
SET NOCOUNT ON;

DECLARE @contador INT
SET @contador = (SELECT ISNULL(COUNT(*),0) FROM tipoCambio WHERE fechaCambio like @fecha)

IF (@contador>=1)
BEGIN
SELECT tipoCambio AS 'cambio' FROM tipoCambio WHERE fechaCambio like @fecha
END
ELSE
BEGIN
SELECT 0 AS 'cambio'
END
END

GO
/****** Object:  StoredProcedure [dbo].[spFechaRecalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spFechaRecalc]
@fRecalc datetime,
@idRet int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranRecalc
UPDATE calculosNormal
SET fechaParaCalculo = @fRecalc
WHERE id = @idRet

IF	(@error<>0)
BEGIN
ROLLBACK TRAN tranRecalc
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranRecalc
SELECT 0 AS 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spFinalizarAjusteVehN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spFinalizarAjusteVehN]
	@idIng int,
	@ajusteCif float,
	@impts float,
	@fechaAjuste date
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN transTras



UPDATE inventarioFiscal SET saldoValorCif = 0, saldoValorImpuesto = 0
WHERE idIngreso = @idIng

INSERT ajustesContables VALUES (@iding, @ajusteCif, @impts, @fechaAjuste)

UPDATE retiroOperacionFiscal SET estadoRet = 6
WHERE idIngresosOP = @idIng

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN transTras
select 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN transTras
select 1 'resp'

END

END


GO
/****** Object:  StoredProcedure [dbo].[spFinalVinculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spFinalVinculo]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


UPDATE ingresosConsolidadoPoliza 
SET estadoOperacion = 1
WHERE id = @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spFinalVN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spFinalVN]
	@idChas int,
	@usuario int

AS
BEGIN
	SET NOCOUNT ON;
declare @error int
begin tran OP
DECLARE @idIng int
SET @idIng = (SELECT idIngreso FROM chasisVehiculosNuevos WHERE id = @idChas)

execute spUpdateIng @idIng
EXECUTE spBitacoraIng @idIng, 'Culminar Ingreso', @usuario, 1
EXECUTE spContaIng @idIng

set @error = @@ERROR
IF (@error!=0)
BEGIN 
ROLLBACK TRAN OP
SELECT 0 'resp'
END
ELSE
BEGIN 
COMMIT TRAN OP
SELECT 1 'resp'
END
END

GO
/****** Object:  StoredProcedure [dbo].[spFinDetalle]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spFinDetalle]
	@fechaBod datetime,
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


IF (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso=1 AND estado=0)=1

	UPDATE historialIngreso
	SET estadoIngreso = 2,
	comentarios = 'Finalizado Bodega',
	fechaBod = @fechaBod ,
	idBod =  @valor 
	WHERE idOp = 1 
ELSE

PRINT 'SINDATA'


END


GO
/****** Object:  StoredProcedure [dbo].[spFinEdit]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spFinEdit]
@idDetalle int,
@estado int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idIngreso int
SET @idIngreso = (SELECT idIngreso FROM detalleDeMercaderia WHERE id = 2)

EXECUTE spEstIng @idIngreso, @estado	

END


GO
/****** Object:  StoredProcedure [dbo].[spGdAlmacenaje]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spGdAlmacenaje]
	@idRegistroCobro int,
	@idIngreso int,
	@rubroAlmacenaje float,
	@fechaCobro date


	AS
BEGIN
	SET NOCOUNT ON;


INSERT INTO [dbo].[cobrosAlmacenajesFiscal]
           ([idRegistroCobro]
           ,[idIngreso]
           ,[rubroAlmacenaje]
           ,[estado]
           ,[fechaCobro]
           ,[fechaEmision])
     VALUES
           (@idRegistroCobro
           ,@idIngreso
           ,@rubroAlmacenaje
           ,1
           ,@fechaCobro
           ,GETDATE())

END




GO
/****** Object:  StoredProcedure [dbo].[spGdOtrosServicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spGdOtrosServicios]
@idRetiro int,
@idOtroGst int,
@rubroOtrosGastos float

	AS
BEGIN
	SET NOCOUNT ON;
INSERT INTO [dbo].[cobroOtrosGastos]
           ([idRetiro]
           ,[idOtroGst]
           ,[rubroOtrosGastos])
     VALUES
           (@idRetiro
           ,@idOtroGst
           ,@rubroOtrosGastos)

END


GO
/****** Object:  StoredProcedure [dbo].[spGdServCobrados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spGdServCobrados]
	@idRetiro int,
	@rubroAlmacenaje float,
	@rubroZonaAduanera float,
	@rubrosManejos float,
	@rubroGastosAdmin float, 
	@marchaElectro float,
	@idUsuario int,
	@revCuad float,
	@idNit int
	
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @err INT
DECLARE @estadoTran INT
DECLARE @fecha datetime
SET @fecha = (SELECT fechaEmision FROM retiroOperacionFiscal WHERE id = @idRetiro)

BEGIN TRAN transOp
DECLARE @estadoRecibo INT
DECLARE @idIng INT
	SET @idIng = (SELECT ing.id FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @idRetiro)
	DECLARE @idIdenty INT
	SET @idIdenty = (SELECT ing.identBodega FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @idRetiro)
	SET @estadoRecibo = (select ISNULL(COUNT(*), 0) from numAsignadoRecibos where idRet = @idRetiro and idIng = @idIng and idIdent = @idIdenty)


IF (@estadoRecibo=0)
BEGIN
IF(@rubroAlmacenaje>0)
BEGIN
	INSERT INTO [dbo].[cobrosAlmacenajes]
           ([idRetiro]
           ,[rubroAlmacenaje])
     VALUES
           (@idRetiro
           ,@rubroAlmacenaje)
END
IF (@rubroZonaAduanera>0)
BEGIN
INSERT INTO [dbo].[cobrosZonaAduanera]
           ([idRetiro]
           ,[rubroZonaAduanera])
     VALUES
           (@idRetiro
           ,@rubroZonaAduanera)
END

IF (@marchaElectro>0)
BEGIN
INSERT INTO [dbo].[cobrosMarchElectro]
           ([idRetiro]
           ,[rubrosMarchElect])
     VALUES
           (@idRetiro
           ,@marchaElectro)
END

IF (@rubrosManejos>0)
BEGIN
INSERT INTO [dbo].[cobrosManejo]
           ([idRetiro]
           ,[rubrosManejos])
     VALUES
           (@idRetiro
           ,@rubrosManejos)
END

IF (@revCuad>0)
BEGIN
INSERT INTO [dbo].[cobrosRevisionIng]
           ([idRetiro]
           ,[rubroRevision])
     VALUES
           (@idRetiro
           ,@revCuad)
END


IF (@rubroGastosAdmin>0)
BEGIN
INSERT INTO [dbo].[cobrosGastosAdmin]
           ([idRetiro]
           ,[rubroGastosAdmin])
     VALUES
           (@idRetiro
           ,@rubroGastosAdmin)
END

	DECLARE @inicioCor INT
	SET @inicioCor = (SELECT numeroInicio FROM inicioCorrelativos)

	DECLARE @estadoRetAs INT
	DECLARE @nuMostrar INT
	SET @estadoRetAs  = (SELECT estadoRet FROM retiroOperacionFiscal WHERE id = @idRetiro)
	


	/*ASIGNANDO NUMERO DE EN CORRELATIVO DE RETIROS*/
	/*SABER SI EXISTE UN CORRELATIVO*/
	DECLARE @proximo_numero INT
	DECLARE @errorTran INT
	DECLARE @categoria INT
	SET @categoria = (SELECT id FROM vinculosDeBodegas WHERE idBodega = @idIdenty)
	DECLARE @idNombreCorrel INT
	SET @idNombreCorrel = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RECIBO')
	DECLARE @estdCorrelativo INT
	SET @estdCorrelativo = (SELECT COUNT(*) FROM numeradorCorrelativos WHERE idCategoria = @categoria AND idnomCorrelativo = @idNombreCorrel )

	IF (@estdCorrelativo=0)
	BEGIN
	EXECUTE spInicioNumerador @categoria, @idNombreCorrel, 0
	END

	update numeradorCorrelativos set @proximo_numero = ultimoNumero = ultimoNumero + 1
	where idCategoria =  @categoria AND idnomCorrelativo = @idNombreCorrel

	INSERT INTO numAsignadoRecibos VALUES (@idRetiro, @idIng, @idIdenty, @proximo_numero, getdate(), @idNit, 1)

	DECLARE @estadoRet INT
	SET @estadoRet = (SELECT ISNULL(retiroOperacionFiscal.estadoRet,0) FROM retiroOperacionFiscal WHERE retiroOperacionFiscal.id = @idRetiro AND retiroOperacionFiscal.idIngresosOP = @idIng )
	IF (@estadoRet=2 OR @estadoRet=3)
	BEGIN
	UPDATE retiroOperacionFiscal 
	SET retiroOperacionFiscal.estadoRet = retiroOperacionFiscal.estadoRet+1
	WHERE retiroOperacionFiscal.id = @idRetiro AND retiroOperacionFiscal.idIngresosOP = @idIng
	/*LA FECHA ES UN PARAMETRO DE BITACORA, YA QUE SINO SE MANDA GENERA UN ERROR EL STORE PRODUCE*/
	EXECUTE spBitacoraRet @idRetiro, 'Recibo Fiscal', @idUsuario,  1, @fecha;	
	END


SET @err = @@ERROR
IF (@err<>0)
BEGIN
ROLLBACK TRAN transOp
select 0 as 'resp'
END
ELSE
BEGIN
COMMIT TRAN transOp
select @inicioCor+@proximo_numero as 'resp'
END
END
ELSE
BEGIN
ROLLBACK TRAN transOp
DECLARE @numeroAsigna INT
SET @numeroAsigna = (select ISNULL(numeroAsignado, 0) from numAsignadoRecibos where idRet = @idRetiro and idIng = @idIng and idIdent = @idIdenty)
DECLARE @inicio INT
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)+@numeroAsigna
SELECT @inicio as 'resp'
END
END

GO
/****** Object:  StoredProcedure [dbo].[spGdServiciosAlt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spGdServiciosAlt]
@idRetiro int,
@idServicio int,
@rubroServiciosAlteracion float

	AS
BEGIN
	SET NOCOUNT ON;
INSERT INTO [dbo].[cobroAlteracionServicios]
           ([idRetiro]
           ,[idServicio]
           ,[rubroServiciosAlteracion])
     VALUES
           (@idRetiro
           ,@idServicio
           ,@rubroServiciosAlteracion)



END


GO
/****** Object:  StoredProcedure [dbo].[spGDVehiculosUsados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spGDVehiculosUsados]
@idIngreso int,
@idDetalle int,
@tipoVehiculo text,
@marcaVehiculo text,
@lineaVehiculo text,
@modeloVehiculo text

	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[vehiculosUsados]
           ([idIngreso]
           ,[idDetalle]
           ,[tipoVehiculo]
           ,[marcaVehiculo]
           ,[lineaVehiculo]
           ,[modeloVehiculo])
     VALUES
(
@idIngreso,
@idDetalle,
@tipoVehiculo,
@marcaVehiculo,
@lineaVehiculo,
@modeloVehiculo
)

END
GO
/****** Object:  StoredProcedure [dbo].[spGenerateExcel]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spGenerateExcel]
@idIngreso int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @correlativoForma int
SET @correlativoForma = (SELECT correlativoFin FROM correlativoFormas)
SELECT ingOp.id + @correlativoForma AS 'numIng', convert(varchar(10),valIngOP.fechaRealIng,23) AS 'fechaIngresoAlSal', convert(varchar(10),ingOp.fechaRegistro,23) AS 'fechaIngresoRegistro',
nt.nombreEmpresa AS 'empresa', nt.nitEmpresa AS 'nit', ingOp.numeroPoliza AS 'numPoliza', inv.saldoBultos AS 'saldoBultos', reg.regimen AS 'regimenPol'
, valIngOP.peso AS 'ingPeso', valIngOP.bultos AS 'bultosIng', valIngOP.valorTotalAduana AS 'aduanaIng', valIngOP.totalValorCif AS 'cifIng', valIngOP.valorImpuesto AS 'imptsIng',
inv.pesoKg AS 'pesoKgSald', valIngOP.totalValorCif, valIngOP.valorImpuesto
FROM ingresoOperacionFiscal ingOp
INNER JOIN inventarioFiscal inv ON ingOp.id = inv.idIngreso 
INNER JOIN valoresIngOpFiscal valIngOP ON valIngOP.idIngreso = ingOp.id
INNER JOIN nit nt ON nt.id = ingOp.idNit AND ingOp.id = @idIngreso
INNER JOIN regimen reg ON reg.id = ingOp.regimen
END


GO
/****** Object:  StoredProcedure [dbo].[spGenerateExcelDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spGenerateExcelDet]
	@idIngreso int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @correlativoForma int
SET @correlativoForma = (SELECT correlativoFin FROM correlativoFormas)
SELECT reOp.id + @correlativoForma AS 'numRet',   convert(varchar(10),reOp.fechaEmision,23) AS 'fechaIngresoAlSal', convert(varchar(10),reOp.fechaEmision,23) AS 'fechaIngresoRegistroSal',
 nt.nombreEmpresa AS 'empresa', nt.nitEmpresa AS 'nit', reOp.polizaRetiro AS 'numPoliza', reOp.regimenSalida AS 'regimenPol',
valRet.bultos AS 'retBultos', valRet.peso AS 'pesoKG'
FROM retiroOperacionFiscal reOp
INNER JOIN valoresRetirosFiscal valRet ON reOp.id = valRet.idRet AND valRet.idIngreso = @idIngreso
INNER JOIN nit nt ON nt.id = reOp.idNit 

END


GO
/****** Object:  StoredProcedure [dbo].[spGestorCliente]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spGestorCliente]

	AS
BEGIN
	SET NOCOUNT ON;
select nit.nitEmpresa AS 'nit', nit.nombreEmpresa AS 'nomEmpresa', nit.direccionEmpresa AS 'direcEmpresa', 
usx.direccionDeRecibos AS 'direRec', usx.direccionFiscal AS 'dirFiscal', usx.email AS 'correo', 
usx.telefono AS 'telCliente', usx.contacto AS 'contactoClietne', usx.foto AS  'fotoCliente', usx.estado AS 'estadoCliente',
personal.nombres AS 'ejecutivoNombre', personal.apellidos AS 'ejecutivoApellido', usx.id
from usuariosExternos usx
INNER JOIN nit ON nit.id = usx.idNit
INNER JOIN personal ON personal.id =  usx.ejecutivoVentas

END
GO
/****** Object:  StoredProcedure [dbo].[spGestorDeTarifas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spGestorDeTarifas]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT usx.id AS 'identificador',  nt.nitEmpresa AS 'numNit', usx.nombreComercial AS 'nombreEmpresa', usx.direccionDeRecibos AS 'direccion',
usx.numeroTarifa AS 'tarifa', usx.contacto as 'Contacto', usx.telefono AS 'telefono', usx.email AS 'correo',  usx.estadoTarifa AS 'estadoDeTarifa'
FROM USUARIOSEXTERNOS usx
INNER JOIN nit nt ON nt.id = usx.idNit



END


GO
/****** Object:  StoredProcedure [dbo].[spGPDependienteVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spGPDependienteVeh]
@valor int

AS
BEGIN
	SET NOCOUNT ON;

select agrupa.id AS 'idGrupo', grupos.nombreEmpresa as 'nombreGrupo', nit.nitEmpresa , nit.nombreEmpresa, nit.direccionEmpresa 
from agrupacionEmpresas agrupa
inner join grupoEmpresas grupos ON grupos.id = agrupa.idEmpGp
inner join nit on nit.id = agrupa.idNitVeh
and grupos.id = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spGruposVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spGruposVeh]


AS
BEGIN
	SET NOCOUNT ON;

select * from grupoEmpresas
END


GO
/****** Object:  StoredProcedure [dbo].[spGuardarToken]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spGuardarToken]
@idPase int,
@token text,
@fechaCreacion datetime
	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[tokensSalidas]
           ([idPase]
           ,[token]
           ,[fechaCreacion])
     VALUES
           (@idPase
           ,@token
           ,@fechaCreacion)
		      SELECT @@IDENTITY AS 'Identity';
END


GO
/****** Object:  StoredProcedure [dbo].[spGuardCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spGuardCalc]
@idIngreso int,
@idDetalle int,
@idNitSalida int,
@poliza text,
@regimen text,
@valorAduanT float,
@tipoCambio float,
@valorCif float,
@valorImpuesto float,
@pesoKG float,
@cantidadBultos float,
@fechaCalculo datetime,
@hiddenDateTime datetime,
@usuario int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranNewCalc
INSERT INTO [dbo].[calculosNormal]
           ([idIngreso]
           ,[idDetalle]
           ,[idNitSalida]
           ,[poliza]
           ,[regimen]
           ,[valorAduanT]
           ,[tipoCambio]
           ,[valorCif]
           ,[valorImpuesto]
           ,[pesoKG]
           ,[cantidadBultos]
           ,[fechaCalculo]
		   ,[fechaParaCalculo]
		   )
     VALUES
           (@idIngreso,
@idDetalle,
@idNitSalida,
@poliza,
@regimen,
@valorAduanT,
@tipoCambio,
@valorCif,
@valorImpuesto,
@pesoKG,
@cantidadBultos,
@fechaCalculo,
@hiddenDateTime
)
DECLARE @ident INT
SET  @ident = @@IDENTITY
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranNewCalc
END
ELSE
BEGIN
COMMIT TRAN tranNewCalc
 /*AS 'Identity';*/
EXECUTE spBitacoraRet @ident, 'Nuevo Calculo', @usuario, 2, @fechaCalculo
SELECT @ident AS 'Identity'
END






END


GO
/****** Object:  StoredProcedure [dbo].[spGuardDetalle]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spGuardDetalle]
@idIngreso int,
@empresa text,
@bultos int,
@peso float,
@estado int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranDetalle
DECLARE @fecha datetime
SET @fecha = (SELECT fechaRealIng FROM valoresIngOpFiscal WHERE id = @idIngreso)

INSERT INTO [dbo].[detalleDeMercaderia]
           ([idIngreso]
           ,[empresa]
           ,[bultos]
           ,[peso]
           ,[estado]
		   ,[fechaRealIng]
		   ,[stock])
     VALUES
(
@idIngreso,
@empresa,
@bultos,
@peso,
@estado,
@fecha,
@bultos
)
DECLARE @key INT
SET @key= @@IDENTITY;
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranDetalle
SELECT 0 AS 'Identity'
END
ELSE
BEGIN
COMMIT TRAN tranDetalle
SELECT @key AS 'Identity'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spHisIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spHisIng]
@ident int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT IFOpe.id AS 'identificador', nit.nitEmpresa AS 'nit', nit.nombreEmpresa AS 'empresa',
IFOpe.numeroPoliza AS 'poliza', sldF.bultos AS 'blts', IFOpe.fechaRegistro AS 'fechaIngreso',
sldF.totalValorCif AS 'cif', sldF.valorImpuesto AS 'impuesto',
IFOpe.estadoIngreso AS 'accionEstado', ser.servicio AS 'servAd'
FROM NIT nit 
INNER JOIN ingresoOperacionFiscal IFOpe ON IFOpe.idNit = nit.id AND  IFOpe.estadoIngreso >= 4 AND IFOpe.identBodega = @ident AND IFOpe.idUsuarioCliente >=1 
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = IFOpe.id 
INNER JOIN servicios ser ON ser.id = IFOpe.idServicio



END
GO
/****** Object:  StoredProcedure [dbo].[spHisIngTodo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spHisIngTodo]
@ident int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @inicioCorre INT
SET @inicioCorre = (SELECT numeroInicio FROM inicioCorrelativos)


SELECT IFOpe.id AS 'identificador', nit.nitEmpresa AS 'nit', nit.nombreEmpresa AS 'empresa',
IFOpe.numeroPoliza AS 'poliza', sldF.bultos AS 'blts', IFOpe.fechaRegistro AS 'fechaIngreso',
sldF.totalValorCif AS 'cif', sldF.valorImpuesto AS 'impuesto',
IFOpe.estadoIngreso AS 'accionEstado', ISNULL(asig.numeroAsignado+@inicioCorre, 0) AS 'numeroAsignado'
FROM NIT nit 
INNER JOIN ingresoOperacionFiscal IFOpe ON IFOpe.idNit = nit.id AND IFOpe.identBodega = @ident
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = IFOpe.id 
LEFT JOIN numAsignadoIngresos asig ON asig.idIng = IFOpe.id



END
GO
/****** Object:  StoredProcedure [dbo].[spHisIngTodoSuper]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spHisIngTodoSuper]
@idBodega int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)


DECLARE @inicioCorre INT
SET @inicioCorre = (SELECT numeroInicio FROM inicioCorrelativos)


SELECT 

IFOpe.id AS 'identificador', nit.nitEmpresa AS 'nit', nit.nombreEmpresa AS 'empresa',
IFOpe.numeroPoliza AS 'poliza', sldF.bultos AS 'blts', 

convert(varchar, IFOpe.fechaRegistro, 103) as 'fechaIngreso',

sldF.totalValorCif AS 'cif', sldF.valorImpuesto AS 'impuesto',

IFOpe.estadoIngreso AS 'accionEstado', 
bod.numeroIdentidad,
UPPER (CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-', bod.numeroIdentidad,'-', YEAR(asig.fechaContabilizado),'-',ISNULL(@inicioCorre+asig.numeroAsignado,0))) as 'numeroAsignado',

IFOpe.identBodega
FROM NIT nit 
INNER JOIN ingresoOperacionFiscal IFOpe ON IFOpe.idNit = nit.id 
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = IFOpe.id 
INNER JOIN bodegas bod on bod.id = IFOpe.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos asig ON asig.idIng = IFOpe.id and asig.idIdent = IFOpe.identBodega
ORDER BY IFOpe.id, asig.numeroAsignado, nit.id, sldF.fechaRealIng ASC


END
GO
/****** Object:  StoredProcedure [dbo].[spHisIngTodoSuperFParam]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[spHisIngTodoSuperFParam]
@idBodega int,
@fechaInicio date,
@fechaFin date
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)


DECLARE @inicioCorre INT
SET @inicioCorre = (SELECT numeroInicio FROM inicioCorrelativos)


SELECT 

IFOpe.id AS 'identificador', nit.nitEmpresa AS 'nit', nit.nombreEmpresa AS 'empresa',
IFOpe.numeroPoliza AS 'poliza', sldF.bultos AS 'blts', 
convert(varchar, IFOpe.fechaRegistro, 103) as 'fechaIngreso',

sldF.totalValorCif AS 'cif', sldF.valorImpuesto AS 'impuesto',

IFOpe.estadoIngreso AS 'accionEstado', 
bod.numeroIdentidad,
UPPER (CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-', bod.numeroIdentidad,'-', YEAR(asig.fechaContabilizado),'-',ISNULL(@inicioCorre+asig.numeroAsignado,0))) as 'numeroAsignado',

IFOpe.identBodega
FROM NIT nit 
INNER JOIN ingresoOperacionFiscal IFOpe ON IFOpe.idNit = nit.id 
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = IFOpe.id 
INNER JOIN bodegas bod on bod.id = IFOpe.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos asig ON asig.idIng = IFOpe.id and asig.idIdent = IFOpe.identBodega

WHERE  sldF.fechaRealIng BETWEEN @fechaInicio AND @fechaFin
ORDER BY IFOpe.id, asig.numeroAsignado, nit.id, sldF.fechaRealIng ASC


END
GO
/****** Object:  StoredProcedure [dbo].[spHisIngTodoSuperPol]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spHisIngTodoSuperPol]
@idBodega int,
@poliza text
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)


DECLARE @inicioCorre INT
SET @inicioCorre = (SELECT numeroInicio FROM inicioCorrelativos)


SELECT 

IFOpe.id AS 'identificador', nit.nitEmpresa AS 'nit', nit.nombreEmpresa AS 'empresa',
IFOpe.numeroPoliza AS 'poliza', sldF.bultos AS 'blts', 
convert(varchar, IFOpe.fechaRegistro, 103) as 'fechaIngreso',

sldF.totalValorCif AS 'cif', sldF.valorImpuesto AS 'impuesto',

IFOpe.estadoIngreso AS 'accionEstado', 
bod.numeroIdentidad,
UPPER (CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-', bod.numeroIdentidad,'-', YEAR(asig.fechaContabilizado),'-',ISNULL(@inicioCorre+asig.numeroAsignado,0))) as 'numeroAsignado',

IFOpe.identBodega
FROM NIT nit 
INNER JOIN ingresoOperacionFiscal IFOpe ON IFOpe.idNit = nit.id 
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = IFOpe.id 
INNER JOIN bodegas bod on bod.id = IFOpe.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos asig ON asig.idIng = IFOpe.id and asig.idIdent = IFOpe.identBodega
WHERE IFOpe.numeroPoliza LIKE  @poliza
ORDER BY IFOpe.id, asig.numeroAsignado, nit.id, sldF.fechaRealIng ASC


END
GO
/****** Object:  StoredProcedure [dbo].[spHisIngTodoSuperTop]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spHisIngTodoSuperTop]
@idBodega int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)


DECLARE @inicioCorre INT
SET @inicioCorre = (SELECT numeroInicio FROM inicioCorrelativos)


SELECT  top(500)

IFOpe.id AS 'identificador', nit.nitEmpresa AS 'nit', nit.nombreEmpresa AS 'empresa',
IFOpe.numeroPoliza AS 'poliza', sldF.bultos AS 'blts', IFOpe.fechaRegistro AS 'fechaIngreso',
sldF.totalValorCif AS 'cif', sldF.valorImpuesto AS 'impuesto',

IFOpe.estadoIngreso AS 'accionEstado', 
bod.numeroIdentidad,
UPPER (CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-', bod.numeroIdentidad,'-', YEAR(asig.fechaContabilizado),'-',ISNULL(@inicioCorre+asig.numeroAsignado,0))) as 'numeroAsignado',

IFOpe.identBodega
FROM NIT nit 
INNER JOIN ingresoOperacionFiscal IFOpe ON IFOpe.idNit = nit.id 
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = IFOpe.id 
INNER JOIN bodegas bod on bod.id = IFOpe.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos asig ON asig.idIng = IFOpe.id and asig.idIdent = IFOpe.identBodega
ORDER BY 
IFOpe.id  DESC


END
GO
/****** Object:  StoredProcedure [dbo].[spHistDataExtraIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spHistDataExtraIng]
@idBodega INT

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

SELECT 
ing.numeroPoliza,
det.idIngreso, nit.nitEmpresa, nit.nombreEmpresa,
 det.empresa AS 'chasis', convert(varchar, val.fechaRealIng, 23) AS 'fechaIngReal',	
det.bultos, det.peso, ing.estadoIngreso,

CONCAT(veh.tipoVehiculo,', ',  veh.marcaVehiculo,', ', veh.lineaVehiculo,', ', veh.modeloVehiculo) as 'descVeh',
veh.ubicacionPredio

	
from detalleDeMercaderia det
INNER JOIN vehiculosUsados veh on veh.idDetalle = det.id
INNER JOIN valoresIngOpFiscal val ON val.idIngreso = det.idIngreso
INNER JOIN ingresoOperacionFiscal ing ON ing.id = det.idIngreso
INNER JOIN bodegas on bodegas.id = ing.identBodega and bodegas.dependencia = @dependencia
INNER JOIN nit on nit.id = ing.idNit

END


GO
/****** Object:  StoredProcedure [dbo].[spHistDataExtraIngExcel]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spHistDataExtraIngExcel]


AS
BEGIN
	SET NOCOUNT ON;


DECLARE @inicio INT
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT 
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-',@inicio+numAsIng.numeroAsignado)) as 'Numero de Ingreso',

ing.numeroPoliza AS 'POLIZA NO.',
nit.nitEmpresa AS 'NIT EMPRESA', nit.nombreEmpresa AS 'NOMBRE EMPRESA',
 det.empresa AS 'CHASIS', convert(varchar, val.fechaRealIng, 23) AS 'FECHA REAL ING',	
det.bultos AS 'BULTOS', det.peso AS 'PESO', 
veh.tipoVehiculo AS 'TIPO',  veh.marcaVehiculo AS 'MARCA', veh.lineaVehiculo AS 'LINEA', veh.modeloVehiculo AS 'MODELO',
veh.ubicacionPredio AS 'UBICACION'

	
from detalleDeMercaderia det
INNER JOIN vehiculosUsados veh on veh.idDetalle = det.id
INNER JOIN valoresIngOpFiscal val ON val.idIngreso = det.idIngreso
INNER JOIN ingresoOperacionFiscal ing ON ing.id = det.idIngreso
INNER JOIN nit on nit.id = ing.idNit
left join numAsignadoIngresos numAsIng ON numAsIng.idIng = ing.id
INNER JOIN BODEGAS bod ON bod.id = ing.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
ORDER BY ing.identBodega, numAsIng.numeroAsignado, nit.id

END


GO
/****** Object:  StoredProcedure [dbo].[spHistoriaCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spHistoriaCalc]
@idBodega int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN historia

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

SELECT nit.nitEmpresa, nit.nombreEmpresa, nit.direccionEmpresa, calculosNormal.poliza AS 'polizaSal', calculosNormal.regimen AS 'regSalida', ingOp.numeroPoliza AS 'polIng',
regimen.regimen AS 'regIng', calculosNormal.fechaCalculo, calculosNormal.fechaParaCalculo, ingOp.id AS 'idIng',
calculosNormal.id
FROM calculosNormal
INNER JOIN nit ON nit.id = calculosNormal.idNitSalida
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = calculosNormal.idIngreso
INNER JOIN valoresIngOpFiscal ON valoresIngOpFiscal.idIngreso = ingOp.id 
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN regimen ON regimen.id = ingOp.regimen
WHERE DATEPART(mm, calculosNormal.fechaCalculo) = DATEPART(mm, DATEADD (mm, 0, GETDATE()))

SET @error = @@ERROR
IF (@error>=1)
BEGIN
ROLLBACK TRAN historia
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN historia
SELECT 1 AS 'resp'
END

end



GO
/****** Object:  StoredProcedure [dbo].[spHistoriaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spHistoriaIng]
@idOp int,
@fechaOp datetime,
@dependencia int,
@estadoIngreso int,
@comentarios text

AS
BEGIN
	SET NOCOUNT ON;


	INSERT INTO [dbo].[historialIngreso]
           ([idOp]
           ,[fechaOp]
           ,[dependencia]
           ,[estadoIngreso]
           ,[comentarios])
     VALUES

       (@idOp,
@fechaOp,
@dependencia,
@estadoIngreso,
@comentarios)


END


GO
/****** Object:  StoredProcedure [dbo].[spHistoriaRec]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spHistoriaRec]


AS
BEGIN
	SET NOCOUNT ON;

DECLARE @inicioCorr INT
SET @inicioCorr = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT   
convert(varchar, retOp.	fechaEmision, 23)  AS 'EMISION DOC', 
ISNULL((@inicioCorr+numAsignaRec.numeroAsignado),0) AS 'NUMERO REC.',
nitRet.nitEmpresa as 'NIT EMPRESA', nitRet.nombreEmpresa AS 'NOMBRE EMPRESA',
nitRet.direccionEmpresa AS 'DIRECCION',
ingOP.identBodega as 'SERIE BOD.',
retOp.polizaRetiro AS 'POLIZA RETIRO',
ISNULL(cbAlm.rubroAlmacenaje,0) AS 'ALMACENAJE', 
ISNULL(cbZA.rubroZonaAduanera,0) AS 'ZONA ADUANERA',
ISNULL(cbAd.rubroGastosAdmin,0) AS 'GASTOS ADMINISTRACION',
ISNULL(cbMa.rubrosManejos,0) AS 'MANEJO',
ISNULL(revIng.rubroRevision,0) AS 'DESCARGA',
ISNULL(cbMarc.rubrosMarchElect,0) AS 'MARCHAMO ELECTRONICO',
regimen.regimen as 'DELEGACION SAT',


ingOP.numeroPoliza AS 'POLIZA INGRESO',
personal.nombres as 'NOMBRES ELABORACION',
retOp.id as 'idRetiro',
retOp.estadoRet as 'ESTADO RETIRO'
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal valRet ON retOp.id = valRet.idRet
INNER JOIN nit nitRet ON nitRet.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOP ON ingOP.id = retOp.idIngresosOP
INNER JOIN regimen ON regimen.id = ingOP.regimen
INNER JOIN nit nitIng ON nitIng.id = ingOP.idNit
LEFT JOIN cobrosAlmacenajes cbAlm ON cbAlm.idRetiro = retOp.id
LEFT JOIN cobrosZonaAduanera cbZA ON cbZA.idRetiro =  retOp.id
LEFT JOIN cobrosGastosAdmin cbAd ON cbAd.idRetiro =  retOp.id
LEFT JOIN cobrosManejo cbMa ON cbMa.idRetiro =  retOp.id 
LEFT JOIN cobrosRevisionIng revIng ON revIng.idRetiro =  retOp.id 
LEFT JOIN cobrosMarchElectro cbMarc ON cbMarc.idRetiro =  retOp.id 
LEFT JOIN numAsignadoRecibos numAsignaRec ON retOp.id = numAsignaRec.idRet
LEFT join nit nitRec on nitrec.id = numAsignaRec.idFact
LEFT JOIN personal ON personal.id = retOp.idUsuario
LEFT JOIN bodegas ON bodegas.id = ingOP.identBodega 
WHERE retOp.estadoRet>=4
ORDER BY  bodegas.numeroIdentidad ASC, (@inicioCorr+numAsignaRec.numeroAsignado) ASC

END


GO
/****** Object:  StoredProcedure [dbo].[spHistoriaRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spHistoriaRet]
@idBodega int

AS
BEGIN
	SET NOCOUNT ON;


DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @inicioCorr INT
SET @inicioCorr = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT   
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-',@inicioCorr+numAsignaRet.numeroAsignado)) AS 'NO. RET',

CONVERT(VARCHAR, retOp.fechaEmision, 23)  AS 'F. EMISION', 

ingOP.numeroPoliza AS 'POL.ING',
regimen.regimen as 'REG. ING',
retOp.polizaRetiro AS 'POL. RET.',
ISNULL(inv.tipo, 'ZA') AS 'ALMACEN',
retOp.regimenSalida AS 'REG SAL.',
nitRet.nitEmpresa AS 'NIT RET',
nitRet.nombreEmpresa AS 'EMPRESA RET',
valRet.bultos as 'BULTOS RET',
valRet.totalValorCif as 'CIF RET',
valRet.valorImpuesto as 'IMPUESTO RET',
retOp.estadoRet as 'ESTADO',
valRet.peso AS 'PESO RET', SUBSTRING(retOp.descripcion, 1,40) AS 'DESCRIPCION' 

FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal valRet ON retOp.id = valRet.idRet
INNER JOIN nit nitRet ON nitRet.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOP ON ingOP.id = retOp.idIngresosOP
INNER JOIN inventarioFiscal inv ON inv.idIngreso = ingOP.id
INNER JOIN regimen ON regimen.id = ingOP.regimen
INNER JOIN nit nitIng ON nitIng.id = ingOP.idNit
LEFT JOIN cobrosAlmacenajes cbAlm ON cbAlm.idRetiro = retOp.id
LEFT JOIN cobrosZonaAduanera cbZA ON cbZA.idRetiro =  retOp.id
LEFT JOIN cobrosGastosAdmin cbAd ON cbAd.idRetiro =  retOp.id
LEFT JOIN cobrosManejo cbMa ON cbMa.idRetiro =  retOp.id 
LEFT JOIN cobrosRevisionIng revIng ON revIng.idRetiro =  retOp.id 
LEFT JOIN cobrosMarchElectro cbMarc ON cbMarc.idRetiro =  retOp.id 
LEFT JOIN numAsignadoRetiros numAsignaRet ON retOp.id = numAsignaRet.idRet
LEFT JOIN personal ON personal.id = retOp.idUsuario
INNER JOIN BODEGAS bod ON bod.id = ingOP.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
WHERE retOp.estadoRet>=4
ORDER BY  bod.numeroIdentidad ASC, (@inicioCorr+numAsignaRet.numeroAsignado) ASC

END


GO
/****** Object:  StoredProcedure [dbo].[spHIstoriaTodosIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spHIstoriaTodosIng]
@idBodega int
	AS
BEGIN
	SET NOCOUNT ON;


DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)
DECLARE @inicio INT
SET @inicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-',@inicio+numAsIng.numeroAsignado)) as 'Numero de Ingreso',
nit.nitEmpresa AS 'NIT', nit.nombreEmpresa AS 'NOMBRE EMPRESA', ing.numeroPoliza AS 'POLIZA ING',
ing.producto AS 'PRODUCTO', ing.estadoIngreso AS 'ESTADO ING', 
 regimen.regimen AS 'REGIMEN',
val.cantidadContenedores AS 'CANT CONTENEDOR', val.cantidadClientes AS 'CANT CLIENTES', val.peso AS 'PESO ING', val.bultos AS 'BULTOS ING', val.valorTotalAduana AS 'V. ADUANA TOTAL', val.tipoCambio AS 'T. CAMBIO', 
val.totalValorCif AS 'VAL CIF', val.valorImpuesto AS 'VAL IMPUESETO',  inv.saldoBultos AS 'SALDO BULTOS',  inv.saldoValorTAduana AS 'SALDO ADUANA', 
inv.saldoValorCif AS 'SALDO CIF', inv.saldoValorImpuesto AS 'SALDO IMPUESTO', detIng.empresa AS 'EMPRESA MANIFIESTO', detIng.bultos AS 'BULTOS MANIFIESTO', detIng.peso AS 'PESO MANIFIESTO', detIng.stock AS 'STOCK BULTOS',
inci.posiciones AS 'CANT POSICIONES', inci.metros AS 'CANT METROS',
convert(varchar, ing.fechaRegistro, 23) AS 'FECHA REGISTRO', convert(varchar, ing.fechaContabilidad, 23) AS 'FECHA CONTABILIDAD', convert(varchar, val.fechaRealIng, 23) AS 'FECHA R. ING', 
LOWER(CONVERT(VARCHAR(32), HashBytes('MD5', CONVERT(varchar, detIng.id)), 2))  AS 'identityDetalle', 
ing.idCartaCupo AS 'C_CUPO',

bod.numeroIdentidad as 'Bodega'


FROM ingresoOperacionFiscal ing
left join valoresIngOpFiscal val on val.idIngreso = ing.id
left join inventarioFiscal inv on inv.idIngreso = ing.id
left join detalleDeMercaderia detIng ON detINg.idIngreso = ing.id
left join incidencia inci on inci.idIngreso  = ing.id
left join personal on personal.id = inci.idUsuario
left join regimen on regimen.id = ing.regimen
INNER JOIN bodegas bod on bod.id = ing.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia

left join numAsignadoIngresos numAsIng ON numAsIng.idIng = ing.id
INNER JOIN nit ON nit.id = ing.idNit
where inci.idDetalle = detIng.id
ORDER BY ing.identBodega, numAsIng.numeroAsignado, nit.id




END


GO
/****** Object:  StoredProcedure [dbo].[spIdentConsul]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spIdentConsul]
@idUsuario int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM DETALLESMERCADERIAS WHERE idUsuario=@idUsuario

END


GO
/****** Object:  StoredProcedure [dbo].[spIdPoliza]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spIdPoliza]

@poliza text,
@tipo int

	AS
BEGIN
	SET NOCOUNT ON;
IF (@tipo=0)
BEGIN
SELECT id FROM ingresoOperacionFiscal where numeroPoliza like @poliza
END
IF (@tipo=1)
BEGIN
SELECT id FROM retiroOperacionFiscal where polizaRetiro like @poliza
END

END
GO
/****** Object:  StoredProcedure [dbo].[spIgualDetalles]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spIgualDetalles]
@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'countDetMerca' FROM detalleDeMercaderia WHERE idIngreso=@valor AND estado>=0 and estado<=2


END


GO
/****** Object:  StoredProcedure [dbo].[spIgualIncidencia]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spIgualIncidencia]
@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'countIncidencia'FROM incidencia WHERE idIngreso=@valor



END


GO
/****** Object:  StoredProcedure [dbo].[spIndentIngresos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spIndentIngresos]
@idBodega int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)

SELECT DISTINCT identBodega AS 'numeroBodegaFiscal' from ingresoOperacionFiscal ingOp
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN empresas ON bodegas.dependencia = empresas.id
where ingOp.estadoIngreso = 5
 

END


GO
/****** Object:  StoredProcedure [dbo].[spIndentRetiros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spIndentRetiros]
@idBodega int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)

select distinct ingOp.identBodega, bod.dependencia  from retiroOperacionFiscal retFiscal
inner join ingresoOperacionFiscal ingOp ON retFiscal.idIngresosOP = ingOp.id AND retFiscal.estadoRet = 5 AND ingOp.estadoIngreso >=5
INNER JOIN bodegas bod on bod.id = ingOp.identBodega and bod.dependencia = @dependencia
END


GO
/****** Object:  StoredProcedure [dbo].[spIngAreasAuto]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spIngAreasAuto]
@valor int,
@valor1 text,
@valor2 int
	AS
BEGIN
	SET NOCOUNT ON;

	SELECT COUNT(*) AS 'cantidad'  from BODEGAS WHERE numeroIdentidad=@valor
	AND areasAutorizadas  LIKE CONCAT('%',@valor1,'%')
	AND dependencia  = @valor2

	


END


GO
/****** Object:  StoredProcedure [dbo].[spIngBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spIngBod]
@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT DT.empresa AS 'nombreEmpresa', inc.descripcionMercaderia AS 'detalleMerca', DT.bultos AS 'blts',
(SELECT ISNULL(SUM(posM.posiciones),0)  FROM posMetrajeBod posM WHERE posM.idIncidencia = inc.id) AS 'posiciones', (SELECT ISNULL(SUM(posM.metraje),0)  FROM posMetrajeBod posM WHERE posM.idIncidencia = inc.id) AS 'metros'

 FROM detalleDeMercaderia DT
INNER JOIN incidencia INC ON DT.idIngreso = INC.idIngreso AND DT.id = INC.idDetalle AND DT.idIngreso = 3714 AND DT.estado>=1
INNER JOIN posMetrajeBod pos ON pos.idIncidencia = inc.id

END
GO
/****** Object:  StoredProcedure [dbo].[spIngEstadoTres]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spIngEstadoTres]

AS
BEGIN
	SET NOCOUNT ON;

SELECT id FROM ingresoOperacionFiscal WHERE estadoIngreso = 3

END


GO
/****** Object:  StoredProcedure [dbo].[spIngInactivas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spIngInactivas]
	@valor int,
    @pasillo int,
    @columna int
AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[INACTIVOS]
           ([idMapeoBodega]
           ,[pasilloY]
           ,[columnaX])
     VALUES
	 (@valor,
@pasillo,
@columna)

END


GO
/****** Object:  StoredProcedure [dbo].[spIngIncidencias]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spIngIncidencias]
@idDetalle int,
@idIngreso int,
@descripcionMercaderia text,
@posiciones int,
@metros float,
@estadoIncidencia int,
@idUsuario int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranGdIncidencia
INSERT INTO [dbo].[incidencia]
           ([idDetalle]
           ,[idIngreso]
           ,[descripcionMercaderia]
           ,[posiciones]
           ,[metros]
           ,[estadoIncidencia]
		   ,[stockPos]
		   ,[stockMts]
           ,[fecha]
		   ,[idUsuario])
     VALUES
	 (
@idDetalle,
@idIngreso,
@descripcionMercaderia,
@posiciones,
@metros,
@estadoIncidencia,
@posiciones,
@metros,
GETDATE(),
@idUsuario)
DECLARE @ident INT
SET @ident = @@IDENTITY;
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranGdIncidencia
SELECT 0 'Identity'
END
ELSE
BEGIN
COMMIT TRAN tranGdIncidencia
SELECT @ident 'Identity'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spIngOpe]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spIngOpe]
@valor int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @partidaCorrelativo INT
SET @partidaCorrelativo = (SELECT numeroInicio FROM inicioCorrelativos)

DECLARE @numroIng INT
SET @numroIng = (SELECT numeroAsignado FROM numAsignadoIngresos where idIng = @valor)
DECLARE @sumNum INT
SET @sumNum = (@numroIng+@partidaCorrelativo)
SELECT INFOPE.id AS 'idIngreso', nit.nitEmpresa AS 'numeroNit', nit.nombreEmpresa AS 'empresa', sldF.totalValorCif 'cif', sldF.valorImpuesto AS 'impuesto', INFOPE.numeroPoliza AS 'poliza', sldF.fechaRealIng AS 'fReal', INFOPE.origenPuerto AS 'origen', INFOPE.bl AS 'bill',
/*dtU.contenedor AS 'container', dtU.placa AS 'plc', dtU.marchamoIng AS 'mrch', dtU.piloto AS 'plto', dtU.licencia AS 'lic',*/ sldF.bultos AS 'blts', bod.areasAutorizadas AS 'area', bod.numeroIdentidad AS 'numeroArea',
INFOPE.dua AS 'numberoDua', reg.regimen AS 'regIngreso', sldf.valorTotalAduana,
 convert(varchar, sldF.fechaRealIng, 25) AS 'fechaRealIng', convert(varchar, INFOPE.fechaRegistro, 25) AS 'fechaOperacion', 
valFob.valorFob	AS 'valFobDolares', sldF.bultos AS 'bultosIngreso', serv.servicio AS 'servicioIng', INFOPE.estadoIngreso, 
UPPER (CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-', bod.numeroIdentidad,'-', YEAR(numIng.fechaContabilizado),'-',@sumNum)) as 'numAsigIng',

empre.nit as 'nitAlm', empre.direccion as 'direAlm', empre.telefono as 'telAlm', empre.email as 'emailAlm', empre.logo as 'logoAlm', empre.empresa as 'empresaInterna'


FROM ingresoOperacionFiscal INFOPE 
INNER JOIN nit nit ON nit.id = INFOPE.idNit
/*INNER JOIN DATOSUNIDADES dtU ON dtU.idIngreso = INFOPE.id AND  dtU.idIngreso=@valor*/
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = INFOPE.id AND sldF.estadoSaldo = 1  AND sldF.idIngreso =@valor
INNER JOIN BODEGAS bod ON bod.id = INFOPE.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
INNER JOIN regimen reg ON reg.id = INFOPE.regimen
INNER JOIN servicios serv ON serv.id = INFOPE.idServicio
LEFT JOIN valoresFob valFob ON valFob.idIngreso = INFOPE.id
left JOIN numAsignadoIngresos numIng ON numIng.idIng = @valor AND numIng.idIdent = INFOPE.identBodega

END


GO
/****** Object:  StoredProcedure [dbo].[spIngPendientes]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spIngPendientes]

@dependencia int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT ingOP.id AS 'numeroOrden', nt.nombreEmpresa AS 'empresa', nt.nitEmpresa AS 'nit', ingOP.numeroPoliza AS 'poliza', sldF.bultos AS 'bultos', ingOP.id AS 'usuario'

  , ISNULL(ingCons.cadenaVinculo, 'NoAplica') AS 'vinculo' , ingCons.estadoOperacion AS 'estadoVinculo', ntCons.nombreEmpresa AS 'consolidadoEmpresa', serv.servicio AS 'servicioFis',
  ingOP.fechaRegistro AS 'emisionOperacion', sldF.fechaRealIng, sldF.cantidadClientes, ingOP.estadoIngreso
  FROM ingresoOperacionFiscal ingOP 
  INNER JOIN nit nt ON nt.id=ingOP.idNit
  INNER JOIN valoresIngOpFiscal sldF ON ingOP.id=sldF.idIngreso AND sldF.estadoSaldo = 1 and ingOP.identBodega = @dependencia
  LEFT JOIN ingresosConsolidadoPoliza ingCons ON ingOP.id = ingCons.idIngreso AND ingCons.tipoOperacion = 1
  LEFT JOIN empresasConsolidadas empCons ON empCons.id = ingCons.idConsolidado
  LEFT JOIN nit ntCons ON ntCons.id = empCons.idNit
  INNER JOIN servicios serv ON serv.id = ingOP.idServicio
  WHERE ingOP.estadoIngreso >= 2 AND ingOP.estadoIngreso <= 3

END
GO
/****** Object:  StoredProcedure [dbo].[spIngPendientesFail]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spIngPendientesFail]

@dependencia int

	AS
BEGIN
	SET NOCOUNT ON;

  SELECT idIngOp.id AS 'numeroOrden', nt.nombreEmpresa AS 'empresa', nt.nitEmpresa AS 'nit', idIngOp.numeroPoliza AS 'poliza', sldF.bultos AS 'bultos', idIngOp.id AS 'usuario'

  , ISNULL(ingCons.cadenaVinculo, 'NoAplica') AS 'vinculo' , ingCons.estadoOperacion AS 'estadoVinculo', ntCons.nombreEmpresa AS 'consolidadoEmpresa', serv.servicio AS 'servicioFis',
  idIngOp.identBodega, idIngOp.estadoIngreso, sldF.cantidadClientes
  
  FROM ingresoOperacionFiscal idIngOp
  INNER JOIN nit nt ON nt.id=idIngOp.idNit
  INNER JOIN valoresIngOpFiscal sldF ON idIngOp.id=sldF.idIngreso
  LEFT JOIN ingresosConsolidadoPoliza ingCons ON idIngOp.id = ingCons.idIngreso AND ingCons.tipoOperacion = 1
  LEFT JOIN empresasConsolidadas empCons ON empCons.id = ingCons.idConsolidado
  LEFT JOIN nit ntCons ON ntCons.id = empCons.idNit 

  INNER JOIN servicios serv ON serv.id = idIngOp.idServicio

  WHERE idIngOp.identBodega = @dependencia and idIngOp.estadoIngreso = 1 OR ((idIngOp.estadoIngreso = 2 AND serv.servicio LIKE 'VEHICULOS NUEVOS' AND idIngOp.identBodega = @dependencia) AND idIngOp.estadoIngreso!=-1)

END
GO
/****** Object:  StoredProcedure [dbo].[spIngRprteContabilizado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spIngRprteContabilizado]
@identB int,
@fecha date

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @identB)

SELECT
ingOp.id AS 'identIng',
numIng.numeroAsignado + @numInicio AS 'numeroDeIngreso', CONVERT(VARCHAR(10), ingOp.fechaContabilidad, 111) AS 'fechaContabilidad', ingOp.numeroPoliza, regimen.regimen,
nit.nombreEmpresa, nit.nitEmpresa, valIngOp.bultos, valIngOp.totalValorCif, valIngOp.valorImpuesto, personal.nombres, personal.apellidos, ingOp.identBodega
FROM
ingresoOperacionFiscal ingOp
INNER JOIN valoresIngOpFiscal valIngOp ON ingOp.id = valIngOp.idIngreso  and ingOp.estadoIngreso = 6
inner JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id
INNER JOIN regimen ON regimen.id = ingOp.regimen
INNER JOIN nit ON nit.id = ingOp.idNit 
LEFT JOIN bitacoraIngresos bitacora ON bitacora.idIngreso = ingOp.id AND bitacora.transaccion LIKE 'Ingreso Contabilizado'
LEFT JOIN personal ON personal.id = bitacora.idUsuario
INNER JOIN bodegas ON bodegas.dependencia = @dependencia AND bodegas.id = ingOp.identBodega
where ingOp.identBodega = @identB AND ingOp.fechaContabilidad = @fecha order by numIng.numeroAsignado ASC

END
GO
/****** Object:  StoredProcedure [dbo].[spIngVehUsados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spIngVehUsados]

@idIng int

	AS
BEGIN
	SET NOCOUNT ON;



DECLARE @vehiculoUsado varchar(100)
set @vehiculoUsado = (SELECT COUNT(*) FROM vehiculosUsados WHERE idIngreso = @idIng)

if (@vehiculoUsado>=1)
begin
select 1 as 'resp'
end
else
begin
select 0 as 'resp'
end




END
GO
/****** Object:  StoredProcedure [dbo].[spInicioNumerador]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spInicioNumerador]
@idCategoria int,
@idnomCorrelativo int,
@ultimoNumero int
	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[numeradorCorrelativos]
           ([idCategoria]
           ,[idnomCorrelativo]
           ,[ultimoNumero])
     VALUES
           (@idCategoria
           ,@idnomCorrelativo
           ,@ultimoNumero)
end



GO
/****** Object:  StoredProcedure [dbo].[spInsertAreasAuto]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spInsertAreasAuto]
@areasAutorizadas text,
@numeroIdentidad int,
@dependencia int

	AS
BEGIN
	SET NOCOUNT ON;



INSERT INTO [dbo].[BODEGAS]
           ([areasAutorizadas]
           ,[numeroIdentidad]
           ,[dependencia])
     VALUES
	(
@areasAutorizadas,
@numeroIdentidad,
@dependencia
	)

SELECT @@IDENTITY AS 'Identity';


		  



END


GO
/****** Object:  StoredProcedure [dbo].[spInsertExtraCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spInsertExtraCalculo]
@idCalculo int,
@idServicio int,
@montoServicio float,
@fechaRegistro datetime,
@estado int,
@tipo int,
@idRet int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN inOtrosSer
DECLARE @revServ int
SET @revServ = (SELECT COUNT(*) FROM serviciosExtrasPrestados WHERE idCalculo = @idCalculo and idServicio = @idServicio and montoServicio = @montoServicio)
IF (@revServ=0)
BEGIN
INSERT INTO [dbo].[serviciosExtrasPrestados]
           ([idCalculo]
           ,[idServicio]
           ,[montoServicio]
           ,[fechaRegistro]
           ,[estado]
		   ,[tipo])
     VALUES
           (@idCalculo
           ,@idServicio
           ,@montoServicio
           ,@fechaRegistro
           ,@estado
		   ,@tipo)

DECLARE @identNewSer int
SET @identNewSer = @@IDENTITY
IF (@idRet>=1 AND @estado=2)
BEGIN

DECLARE @valida INT
SET @valida = (SELECT ISNULL(COUNT(*),0) FROM otrosServiciosDescuentos WHERE idOperacion = @identNewSer AND tipoOp = 1)
IF (@valida=0)
BEGIN
INSERT INTO [dbo].[otrosServiciosDescuentos]
           ([idRet]
           ,[idOperacion]
           ,[tipoOp]
           ,[fechaEmision])
     VALUES
           (@idRet
           ,@identNewSer
           ,1
           ,GETDATE())
END
END
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN inOtrosSer
SELECT 0 AS 'sp'
END
ELSE
BEGIN
COMMIT TRAN inOtrosSer
SELECT 1 AS 'sp'
END
END
ELSE
BEGIN
SELECT 1 AS 'sp'
END

END
GO
/****** Object:  StoredProcedure [dbo].[spInsertNewAreaBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spInsertNewAreaBod]
	@idBod int,
	@nombreArea text,
	@descr text,
	@tiempo int,
	@fecha date

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranArea
INSERT INTO [dbo].[areasBodegas]
           ([idBodega]
           ,[nombreArea]
           ,[descripcionArea]
           ,[tiempo]
           ,[fechaVencimiento])
     VALUES
           (@idBod
           ,@nombreArea
           ,@descr
           ,@tiempo
           ,@fecha)

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranArea
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranArea
SELECT 1 'resp'
END

END




GO
/****** Object:  StoredProcedure [dbo].[spInsertNewEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spInsertNewEmpresa]
@nit text,
@empresa text,
@direcion text,
@telefono text,
@email text,
@logo text,
@establecimiento text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
BEGIN TRAN tranNewEm

	INSERT INTO [dbo].[empresas]
           ([nit]
           ,[empresa]
		   ,[establecimiento]
           ,[direccion]
           ,[telefono]
           ,[email]
           ,[logo]
		   ,[estado]
		   ,[fechaCreacion])
     VALUES
           (@nit
           ,@empresa
		   ,@establecimiento
           ,@direcion
           ,@telefono
           ,@email
           ,@logo
		   ,1
		   ,GETDATE())

set @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranNewEm
SELECT 0  'resp'
END
ELSE
BEGIN
COMMIT TRAN tranNewEm
SELECT 1  'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spInsertNormales]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spInsertNormales]
                     @baseAlmacenaje text
           ,@PeriodoAlmacenaje text
           ,@tarifaAlmacenaje float
           ,@baseZonaAduanera text
           ,@PeriodoZonaAduanera text
           ,@tarifaZonaAduanera float
           ,@baseManejo text
           ,@tarifaManejo float
           ,@baseGastosAdmin text
           ,@tarifaGastosAdministrativos float
           ,@baseGastosFotocopias text
           ,@tarifaFotocopias float
           ,@baseCalculoDescargaRevision text
           ,@calculoDescargaRevision float
		   ,@baseCalculoOtrosGastos text
           ,@calculoOtrosGastos float
           ,@fechaTarifa date
           ,@fechaVigencia date
           ,@fechaVencimiento date
AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[tarifasNormal]
           ([baseAlmacenaje]
           ,[PeriodoAlmacenaje]
           ,[tarifaAlmacenaje]
           ,[baseZonaAduanera]
           ,[PeriodoZonaAduanera]
           ,[tarifaZonaAduanera]
           ,[baseManejo]
           ,[tarifaManejo]
           ,[baseGastosAdmin]
           ,[tarifaGastosAdministrativos]
           ,[baseGastosFotocopias]
           ,[tarifaFotocopias]
           ,[baseCalculoDescargaRevision]
           ,[calculoDescargaRevision]
           ,[baseCalculoOtrosGastos]
           ,[calculoOtrosGastos]
           ,[fechaTarifa]
           ,[fechaVigencia]
           ,[fechaVencimiento])
     VALUES
          (@baseAlmacenaje,
			@PeriodoAlmacenaje
           ,@tarifaAlmacenaje
           ,@baseZonaAduanera
           ,@PeriodoZonaAduanera
           ,@tarifaZonaAduanera
           ,@baseManejo
           ,@tarifaManejo
           ,@baseGastosAdmin
           ,@tarifaGastosAdministrativos
           ,@baseGastosFotocopias
           ,@tarifaFotocopias
           ,@baseCalculoDescargaRevision
           ,@calculoDescargaRevision
		   ,@baseCalculoOtrosGastos
		   ,@calculoOtrosGastos
           ,@fechaTarifa
           ,@fechaVigencia
           ,@fechaVencimiento)


END


GO
/****** Object:  StoredProcedure [dbo].[spInsertNormales1]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[spInsertNormales1]
            @Dependencia_Nit text
		   ,@Regimen_Nit text
           ,@Tipo_Direccion text
 		   ,@baseAlmacenaje text
           ,@PeriodoAlmacenaje text
           ,@tarifaAlmacenaje float
           ,@baseZonaAduanera text
           ,@PeriodoZonaAduanera text
           ,@tarifaZonaAduanera float
           ,@baseManejo text
           ,@tarifaManejo float
           ,@baseGastosAdmin text
           ,@tarifaGastosAdministrativos float
           ,@baseGastosFotocopias text
           ,@tarifaFotocopias float
           ,@baseCalculoDescargaRevision text
           ,@calculoDescargaRevision float
		   ,@baseCalculoOtrosGastos text
           ,@calculoOtrosGastos float
           ,@fechaTarifa date
           ,@fechaVigencia date
           ,@fechaVencimiento date
AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[tarifasNormales]
           ([Dependencia_Nit]
           ,[Regimen_Nit]
           ,[Tipo_Direccion]
           ,[baseAlmacenaje]
           ,[PeriodoAlmacenaje]
           ,[tarifaAlmacenaje]
           ,[baseZonaAduanera]
           ,[PeriodoZonaAduanera]
           ,[tarifaZonaAduanera]
           ,[baseManejo]
           ,[tarifaManejo]
           ,[baseGastosAdmin]
           ,[tarifaGastosAdministrativos]
           ,[baseGastosFotocopias]
           ,[tarifaFotocopias]
           ,[baseCalculoDescargaRevision]
           ,[calculoDescargaRevision]
           ,[baseCalculoOtrosGastos]
           ,[calculoOtrosGastos]
           ,[fechaTarifa]
           ,[fechaVigencia]
           ,[fechaVencimiento])
     VALUES
          ( @Dependencia_Nit
 ,@Regimen_Nit
 ,@Tipo_Direccion
 ,@baseAlmacenaje
 ,@PeriodoAlmacenaje
 ,@tarifaAlmacenaje
 ,@baseZonaAduanera
 ,@PeriodoZonaAduanera
 ,@tarifaZonaAduanera
 ,@baseManejo
 ,@tarifaManejo
 ,@baseGastosAdmin
 ,@tarifaGastosAdministrativos
 ,@baseGastosFotocopias
 ,@tarifaFotocopias
 ,@baseCalculoDescargaRevision
 ,@calculoDescargaRevision
 ,@baseCalculoOtrosGastos
 ,@calculoOtrosGastos
 ,@fechaTarifa
 ,@fechaVigencia
 ,@fechaVencimiento
)


END


GO
/****** Object:  StoredProcedure [dbo].[spInsertTresC]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spInsertTresC]
@idUsuario int,
@idArea int,
@fechaNavega datetime
AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[NAVEGACION]
           ([idUsuario]
           ,[idArea]
           ,[fechaNavega])
     VALUES
	       (
		   @idUsuario,
		   @idArea,
		   @fechaNavega
		   )

END


GO
/****** Object:  StoredProcedure [dbo].[spInsertValFob]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spInsertValFob]
@idIngreso int,
@valorFob float
AS
BEGIN
	SET NOCOUNT ON;


INSERT INTO [dbo].[valoresFob]
           ([idIngreso]
           ,[valorFob])
     VALUES
           (@idIngreso
           ,@valorFob)

END


GO
/****** Object:  StoredProcedure [dbo].[spInsRetiro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spInsRetiro]

@idIngresosOP int,
@idNit int,
@polizaRetiro text,
@regimenSalida text,
@descripcion text,
@idUsuario int,
@idDependencia int,
@estadoRet int,
@detallesRebajados text,
@fechaEmision datetime,
@bultos int,
@peso float,
@tipoCambio float,
@valorTotalAduana float,
@totalValorCif float,
@valorImpuesto float,
@licencia text,
@piloto text,
@placa text,
@contenedores text,
@usuario int,
@tipoIng int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN gdRetiro

DECLARE @dependencia INT
SET @dependencia = (SELECT identBodega FROM ingresoOperacionFiscal WHERE id = @idIngresosOP)

INSERT INTO [dbo].[retiroOperacionFiscal]
           ([idIngresosOP]
           ,[idNit]
           ,[polizaRetiro]
           ,[regimenSalida]
           ,[descripcion]
           ,[idUsuario]
           ,[idDependencia]
           ,[estadoRet]
           ,[detallesRebajados]
           ,[fechaEmision]
)
     VALUES
           (
            @idIngresosOP
           ,@idNit
           ,@polizaRetiro
           ,@regimenSalida
           ,@descripcion
           ,@idUsuario
           ,@dependencia
           ,@estadoRet
           ,@detallesRebajados
           ,@fechaEmision
 
           )

DECLARE @ret INT
SET @ret = @@IDENTITY;


INSERT INTO [dbo].[valoresRetirosFiscal]
           ([idIngreso]
           ,[idRet]
           ,[bultos]
           ,[peso]
           ,[tipoCambio]
           ,[valorTotalAduana]
           ,[totalValorCif]
           ,[valorImpuesto]
           ,[estadoSaldo])
     VALUES
           (
            @idIngresosOP
           ,@ret
           ,@bultos
           ,@peso
           ,@tipoCambio
           ,@valorTotalAduana
           ,@totalValorCif
           ,@valorImpuesto
           ,@estadoRet
           )





SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN gdRetiro
SELECT 0 AS 'Identity'
END
ELSE
BEGIN
COMMIT TRAN gdRetiro
SELECT @ret AS 'Identity'
IF (@tipoIng = 0)
BEGIN
EXECUTE spUnidadesRet @licencia, @piloto, @placa, @contenedores, @ret
EXECUTE spBitacoraRet @ret, 'Nuevo Retiro', @usuario, 1, @fechaEmision
END
ELSE
BEGIN
EXECUTE spBitacoraRet @ret, 'Nuevo Retiro', @usuario, 1, @fechaEmision
END

END
END
GO
/****** Object:  StoredProcedure [dbo].[spInsRetiroVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spInsRetiroVeh]

@idIngresosOP int,
@idNit int,
@polizaRetiro text,
@regimenSalida text,
@descripcion text,
@idUsuario int,
@idDependencia int,
@estadoRet int,
@fechaEmision datetime,
@bultos int,
@peso float,
@tipoCambio float,
@valorTotalAduana float,
@totalValorCif float,
@valorImpuesto float


	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
BEGIN TRAN tranRetVeh


DECLARE @dependencia INT
SET @dependencia = (SELECT identBodega FROM ingresoOperacionFiscal WHERE id = @idIngresosOP)

INSERT INTO [dbo].[retiroOperacionFiscal]
           ([idIngresosOP]
           ,[idNit]
           ,[polizaRetiro]
           ,[regimenSalida]
           ,[descripcion]
           ,[idUsuario]
           ,[idDependencia]
           ,[estadoRet]
           ,[detallesRebajados]
           ,[fechaEmision]
)
     VALUES
           (
            @idIngresosOP
           ,@idNit
           ,@polizaRetiro
           ,@regimenSalida
           ,@descripcion
           ,@idUsuario
           ,@dependencia
           ,@estadoRet
           ,'VEHICULOS NUEVOS'
           ,@fechaEmision
 
           )


DECLARE @ret INT
SET @ret = @@IDENTITY

INSERT INTO [dbo].[valoresRetirosFiscal]
           ([idIngreso]
           ,[idRet]
           ,[bultos]
           ,[peso]
           ,[tipoCambio]
           ,[valorTotalAduana]
           ,[totalValorCif]
           ,[valorImpuesto]
           ,[estadoSaldo])
     VALUES
           (
            @idIngresosOP
           ,@ret
           ,@bultos
           ,@peso
           ,@tipoCambio
           ,@valorTotalAduana
           ,@totalValorCif
           ,@valorImpuesto
           ,@estadoRet
           )

UPDATE detalleDeMercaderia SET stock = stock - @bultos WHERE idIngreso = @idIngresosOP

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN gdRetiro
SELECT 0 AS 'Identity'
END
ELSE
BEGIN
COMMIT TRAN gdRetiro

EXECUTE spBitacoraRet @ret, 'Nuevo Retiro', @idUsuario, 1, @fechaEmision
SELECT @ret AS 'Identity'
END



END
GO
/****** Object:  StoredProcedure [dbo].[spInsUnidades]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spInsUnidades]

@idOp int,
@piloto int,
@unidadPlaca int,
@unidadContenedor int,
@tipoOp int,
@marchamo text

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranSQLUnidad
 
DECLARE @resultLic int
SET  @resultLic = (SELECT ISNULL(COUNT(*), 0) FROM datosUnidades WHERE idOp = @idOp AND piloto = @piloto and tipoOp = @tipoOp)



DECLARE @resultPlaca int
SET @resultPlaca =  (SELECT ISNULL(COUNT(*), 0) FROM datosUnidades WHERE idOp = @idOp AND unidadPlaca = @unidadPlaca and tipoOp = @tipoOp)


DECLARE @resultCont int
SET @resultCont =  (SELECT ISNULL(COUNT(*), 0) FROM datosUnidades WHERE idOp = @idOp AND unidadContenedor = @unidadContenedor and tipoOp = @tipoOp)



DECLARE @resultSum int
SET @resultSum = (@resultLic + @resultPlaca)

DECLARE @resp INT

IF (@resultSum=0)
BEGIN
INSERT INTO [dbo].[datosUnidades]
           ([idOp]
           ,[piloto]
           ,[unidadPlaca]
           ,[unidadContenedor]
		   ,[marchamo]
           ,[tipoOp]
		   ,[estado])
     VALUES
           (@idOp
           ,@piloto
           ,@unidadPlaca
           ,@unidadContenedor
		   ,@marchamo
           ,@tipoOp
		   ,1)

   SET @resp = @@IDENTITY;
   /*AS 'Identity'*/
END
ELSE
BEGIN
   SET @resp =0;
END

SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranSQLUnidad
SELECT @resp AS 'Identity'
END
ELSE
BEGIN
COMMIT TRAN tranSQLUnidad
SELECT @resp AS 'Identity'
END




END
GO
/****** Object:  StoredProcedure [dbo].[spJefeRepConta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spJefeRepConta]
@idBodega int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)

select personal.nombres, personal.apellidos from personal
INNER join departamentos ON departamentos.id = personal.departamento AND departamentos.departamentos LIKE 'Operaciones Fiscales'
INNER JOIN nivelesSistema ON personal.nivel = nivelesSistema.id and nivelesSistema.nivelUsuario LIKE 'MEDIO' AND personal.dependencia = @dependencia 

END


GO
/****** Object:  StoredProcedure [dbo].[spListaVehUsados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spListaVehUsados]

	@idBodega int
	

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)


SELECT nit.nitEmpresa, nit.nombreEmpresa, ingF.numeroPoliza, detChasis.empresa, vehUsado.tipoVehiculo,
vehUsado.lineaVehiculo, detChasis.id
FROM detalleDeMercaderia detChasis
inner join vehiculosUsados vehUsado on detChasis.id = vehUsado.idDetalle
inner join incidencia on incidencia.idDetalle = detChasis.id
INNER JOIN ingresoOperacionFiscal ingF ON ingF.id = detChasis.idIngreso
INNER JOIN nit ON nit.id = ingF.idNit
INNER JOIN bodegas ON
bodegas.dependencia = @dependencia 
AND bodegas.areasAutorizadas LIKE 'Predio de Vehiculos Usados' 

END
GO
/****** Object:  StoredProcedure [dbo].[spMapa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMapa]
@idDet int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idIngreso int
SET @idIngreso = (SELECT idIngreso FROM detalleDeMercaderia WHERE id = @idDet)

DECLARE @idBodega int
SET @idBodega = (SELECT identBodega FROM ingresoOperacionFiscal WHERE id= @idIngreso)

select pasY AS 'pasillos', colX AS 'columnas' from mapeoAreas WHERE id= @idBodega

END


GO
/****** Object:  StoredProcedure [dbo].[spMaxContabilidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spMaxContabilidad]

AS
BEGIN
	SET NOCOUNT ON;

SELECT convert(varchar, max(fecha), 23) as 'fechaMaxima' from correaltivoPoliza

END


GO
/****** Object:  StoredProcedure [dbo].[spMedidasVehN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spMedidasVehN]
	@idMedida int,
	@largoMts float,
	@anchoMts float,
	@retrovisoresMts float,
	@espacioLateral float,
	@espacioFrontal float



AS
BEGIN
	SET NOCOUNT ON;

UPDATE [dbo].[medidasVehiculos]
   SET [largoMts] = @largoMts
      ,[anchoMts] = @anchoMts
      ,[retrovisoresMts] = @retrovisoresMts
      ,[espacioLateral] = @espacioLateral
      ,[espacioFrontal] = @espacioFrontal
 WHERE id=@idMedida


END


GO
/****** Object:  StoredProcedure [dbo].[spMedidaVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spMedidaVeh]
	@idTipoVeh text,
	@linea text
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT   
BEGIN TRAN tranLineas
DECLARE @vehiculo int
SET @vehiculo =  (select ISNULL(id, 0) from tiposDeVehiculos where tipoVehiculo LIKE @idTipoVeh)
IF (@vehiculo=0)
BEGIN
INSERT tiposDeVehiculos
VALUES (@idTipoVeh)
DECLARE @idNuevTipo INT
SET @idNuevTipo = @@IDENTITY
INSERT INTO [dbo].[medidasVehiculos] ([idTipoVeh], [linea]) VALUES (@idNuevTipo, @linea)

END
ELSE
BEGIN
INSERT INTO [dbo].[medidasVehiculos] ([idTipoVeh], [linea]) VALUES (@vehiculo, @linea)

END


SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranLineas
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranLineas
SELECT 1 AS 'resp'
END

END

GO
/****** Object:  StoredProcedure [dbo].[spMetrajeVehi]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMetrajeVehi]

	AS
BEGIN
	SET NOCOUNT ON;

select mdVeh.id AS 'identy', tpVeh.tipoVehiculo AS 'tipoV', mdVeh.linea AS 'tipoLinea', mdVeh.largoMts AS 'largo', mdVeh.anchoMts AS 'ancho', mdVeh.retrovisoresMts AS 'retrovisor',
mdVeh.espacioLateral AS 'lateral', mdVeh.espacioFrontal AS 'frontal'
  FROM tiposDeVehiculos tpVeh
INNER JOIN medidasVehiculos mdVeh ON tpVeh.id = mdVeh.idTipoVeh

END


GO
/****** Object:  StoredProcedure [dbo].[spMetrosPosInci]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spMetrosPosInci]
@idIncidencia int
,@idAreaBod int
,@posiciones int
,@metraje float
,@promedio float

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranMetraje

INSERT INTO [dbo].[posMetrajeBod]
           ([idIncidencia]
           ,[idAreaBod]
           ,[posiciones]
           ,[metraje]
           ,[promedio]
		   ,[stockPos]
		   ,[stockMetraje])
     VALUES
           (@idIncidencia
           ,@idAreaBod
           ,@posiciones
           ,@metraje
           ,@promedio
           ,@metraje
           ,@promedio)

SET @error = @@ERROR

IF	(@error!=0)
BEGIN
ROLLBACK TRAN tranMetraje
SELECT 0 
END
ELSE
BEGIN 
COMMIT TRAN tranMetraje
SELECT 1
END
END


GO
/****** Object:  StoredProcedure [dbo].[spMigraEstadoIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spMigraEstadoIng]
	@idIng int,
	@usuario int
AS
BEGIN
	SET NOCOUNT ON;



DECLARE @vehUs int
set @vehUs = (SELECT COUNT(*) FROM vehiculosUsados WHERE idIngreso = @idIng)
IF (@vehUs=0)
BEGIN
EXECUTE spUpdateIngEstado @idIng
END

EXECUTE spContaIng @idIng
EXECUTE spBitacoraIng @idIng, 'Culminar Ingreso', @usuario, 1

END


GO
/****** Object:  StoredProcedure [dbo].[spModificarCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spModificarCalc]
@idIngreso int,
@idDetalle int,
@idNitSalida int,
@poliza text,
@regimen text,
@valorAduanT float,
@tipoCambio float,
@valorCif float,
@valorImpuesto float,
@pesoKG float,
@cantidadBultos float,
@fechaCalc date,
@usuario INT

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranMofCal
UPDATE [dbo].[calculosNormal]
SET 
idNitSalida = @idNitSalida,
poliza = @poliza,
regimen = @regimen,
valorAduanT = @valorAduanT,
tipoCambio = @tipoCambio,
valorCif = @valorCif,
valorImpuesto = @valorImpuesto,
pesoKG = @pesoKG,
cantidadBultos = @cantidadBultos,
fechaParaCalculo = @fechaCalc

WHERE idIngreso = @idIngreso AND poliza LIKE @poliza
DECLARE @idCalc INT
SET @idCalc = (SELECT id  FROM calculosNormal WHERE idIngreso = @idIngreso AND poliza LIKE @poliza)
EXECUTE spBitacoraRet @idCalc, 'Modificacion Calculo', @usuario, 2, @fechaCalc
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranMofCal
END
ELSE
BEGIN
COMMIT TRAN tranMofCal
SELECT id AS 'Identity' FROM calculosNormal WHERE idIngreso = @idIngreso AND poliza LIKE @poliza
END




END


GO
/****** Object:  StoredProcedure [dbo].[spModificarRubrosSerCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spModificarRubrosSerCalc]
	@idCalculo int,
	@idServicio int,
	@tipo int,
	@valor int,
	@estado int,
	@idRet int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranModServ


UPDATE serviciosExtrasPrestados SET montoServicio = @valor,  estado = @estado, fechaRegistro = GETDATE()  WHERE idCalculo = @idCalculo AND idServicio = @idServicio AND tipo = @tipo

IF (@idRet>=1 AND @estado=2)
BEGIN
DECLARE @idSer INT
SET @idSer = (SELECT ISNULL(id,0) FROM serviciosExtrasPrestados WHERE idCalculo = @idCalculo AND idServicio = @idServicio AND tipo = @tipo)

DECLARE @valida INT
SET @valida = (SELECT ISNULL(COUNT(*),0) FROM otrosServiciosDescuentos WHERE idOperacion = @idSer AND tipoOp = 1)
IF (@valida=0)
BEGIN
INSERT INTO [dbo].[otrosServiciosDescuentos]
           ([idRet]
           ,[idOperacion]
           ,[tipoOp]
           ,[fechaEmision])
     VALUES
           (@idRet
           ,@idSer
           ,1
           ,GETDATE())
END

END
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranModServ
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranModServ
SELECT 1 AS 'resp'
END
END
GO
/****** Object:  StoredProcedure [dbo].[spModStock]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spModStock]
@idDet int,
@nuevoSaldo int
	AS
BEGIN
	SET NOCOUNT ON;

UPDATE detalleDeMercaderia
SET stock = @nuevoSaldo
WHERE id = @idDet



END
GO
/****** Object:  StoredProcedure [dbo].[spModStockAnterior]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spModStockAnterior]
@idDet int,
@nuevoSaldo int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error int
BEGIN TRAN tranModificaStock
/*reversion de dealle mercaderia*/

DECLARE @stock INT
SET @stock = (SELECT stock FROM detalleDeMercaderia WHERE id = @idDet)+@nuevoSaldo
DECLARE @blts INT
SET @blts = (SELECT stock FROM detalleDeMercaderia WHERE id = @idDet)
IF (@blts<=@stock)
BEGIN
UPDATE detalleDeMercaderia
SET stock =stock + @nuevoSaldo
WHERE id = @idDet

set @error= @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranModificaStock
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranModificaStock
SELECT 1 'resp'
END
END
ELSE
BEGIN
SELECT 1 'resp'
END

END
GO
/****** Object:  StoredProcedure [dbo].[spMontarguista]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMontarguista]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


SELECT personal.id AS 'idMontarcaga', personal.nombres, personal.apellidos, personal.telefono, personal.email, personal.foto FROM personal WHERE id = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spMostraLineasSinMed]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spMostraLineasSinMed]


	AS
BEGIN
	SET NOCOUNT ON;

select mdV.id AS 'identificaMedida', tpV.tipoVehiculo AS 'tVeh', mdV.linea AS 'lVeh' from medidasVehiculos mdV 
INNER JOIN tiposDeVehiculos tpV ON mdV.idTipoVeh	= tpV.id
where largoMts IS NULL 



END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarAreasBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spMostrarAreasBod]
	@idBodega int

AS
BEGIN
	SET NOCOUNT ON;

select * from areasBodegas where idBodega = @idBodega

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarChasis]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spMostrarChasis]

@valor int

	AS
BEGIN


SELECT 
chasisV.id, chasisV.chasis, tipV.tipoVehiculo, mdv.linea, prdV.predio, prdV.descripcion, chasisV.estado
FROM chasisVehiculosNuevos chasisV
INNER JOIN medidasVehiculos mdv ON mdv.id = chasisV.lineaVehiculo AND chasisV.idIngreso = @valor
left JOIN tiposDeVehiculos tipV ON tipV.id = chasisV.tipoVehiculo AND chasisV.estado >= 1
left JOIN prediosDeVehiculos prdV ON prdV.id = chasisV.ubicacion

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarCodigoOPB]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spMostrarCodigoOPB]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT

*
    
FROM
    codigosCif
	WHERE idNit=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarDetCont]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spMostrarDetCont]
@ident int
	AS
BEGIN
	SET NOCOUNT ON;


SELECT 
empresas.empresa, bodegas.areasAutorizadas, bodegas.numeroIdentidad, bodegas.dependencia 
from ingresoOperacionFiscal ingOp
INNER JOIN bodegas ON bodegas.numeroIdentidad = ingOp.identBodega
INNER JOIN empresas ON bodegas.dependencia = empresas.id
WHERE ingOp.identBodega = @ident


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarDetI]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMostrarDetI]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT DTM.idIngreso AS	'idDetalle', INCD.idDetalle, DTM.empresa AS 'RazonSocial', INCD.descripcionMercaderia AS 'detalle', DTM.bultos AS 'blts',
ingOP.numeroPoliza
FROM detalleDeMercaderia DTM
INNER JOIN incidencia INCD ON DTM.idIngreso = INCD.idDetalle AND DTM.id=INCD.idIngreso AND DTM.idIngreso=@valor AND INCD.idIngreso=@valor
INNER JOIN ingresoOperacionFiscal ingOP ON ingOP.id=DTM.idIngreso

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarEmpreEdit]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spMostrarEmpreEdit]
	@empresa int

AS
BEGIN
	SET NOCOUNT ON;

	SELECT * FROM empresas where id=@empresa


END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarEmpresas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spMostrarEmpresas]


AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM empresas
END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarEstado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMostrarEstado]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;

SELECT TOP (1) ing.id, dt.empresa, inci.descripcionMercaderia, sldf.bultos, sldf.peso FROM valoresIngOpFiscal sldf
INNER JOIN ingresoOperacionFiscal ing ON ing.id = sldf.idIngreso  AND estadoSaldo = 1  AND ing.id = @valor
INNER JOIN detalleDeMercaderia dt ON dt.idIngreso = ing.id
INNER JOIN incidencia inci ON inci.idDetalle = dt.id 
ORDER BY estadoSaldo DESC 


END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarFila]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spMostrarFila]
	@idCliente int,
	@valorTarifa int
AS
BEGIN
	SET NOCOUNT ON;

SELECT SERVI.servicio, AL.idTarifa AS "claveAlmacenaje", SG.idSeguro AS "claveSeguro", MN.idManejo AS "claveManejo", GSTAD.idgastosAdmin AS "claveGtosAdmin", OTROS.idotrosGastos AS "claveOtrosGtos"
FROM ALMACENAJES AL
INNER JOIN usuariosExternos USC ON AL.idUsuarioCliente = USC.id AND USC.id=@idCliente
LEFT JOIN SEGURO SG ON AL.idUsuarioCliente=SG.idUsuarioCliente AND SG.idUsuarioCliente=@idCliente AND SG.idTarifa=AL.idTarifa
LEFT JOIN MANEJO MN ON AL.idUsuarioCliente=MN.idUsuarioCliente AND MN.idUsuarioCliente=@idCliente AND MN.idTarifa=AL.idTarifa
LEFT JOIN GASTOS_ADMIN GSTAD ON AL.idUsuarioCliente=GSTAD.idUsuarioCliente AND GSTAD.idUsuarioCliente=@idCliente AND GSTAD.idTarifa=AL.idTarifa
LEFT JOIN OTROS_GASTOS OTROS ON AL.idUsuarioCliente=OTROS.idUsuarioCliente AND OTROS.idUsuarioCliente=@idCliente AND OTROS.idTarifa=AL.idTarifa
INNER JOIN SERVICIOS SERVI ON AL.idServicio=SERVI.id AND AL.idTarifa=@valorTarifa;


END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarGestorus]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMostrarGestorus]

AS
BEGIN
	SET NOCOUNT ON;

SELECT 
usuarios, nombres, apellidos,
dep.departamentos AS 'funcion',
niv.nivelUsuario AS 'nivel', per.foto,
per.estado, per.id, per.email
FROM personal per
INNER JOIN departamentos dep ON per.departamento = dep.id
INNER JOIN nivelesSistema niv ON per.nivel = niv.id

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarIngBod1]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMostrarIngBod1]

@fecha DATE

	AS
BEGIN
	SET NOCOUNT ON;

SELECT ingOp.id AS 'ident',  nt.nitEmpresa AS 'nit', ingOp.fechaRealIng AS 'fReal', ingOp.fechaRegistro AS 'fRegistro', nt.nombreEmpresa AS 'empresa', ingOp.numeroIngreso AS 'ingreso', ingOp.numeroPoliza AS 'poliza', ingOp.fechaRegistro AS 'fechaOp', 
ingOp.bultos AS 'blts', ingOp.totalValorCif AS 'cif', ingOp.valorImpuesto AS 'impts' 
FROM INGOPERACIONES ingOp
INNER JOIN NIT nt ON nt.id = ingOp.idNit AND ingOp.fechaRegistro LIKE @fecha AND ingOp.estadoIngreso=2
ORDER BY ingOp.numeroIngreso

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarIngBod2]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMostrarIngBod2]

@fechaInicio DATE,
@fechaFin DATE
	AS
BEGIN
	SET NOCOUNT ON;

SELECT ingOp.id AS 'ident', nt.nitEmpresa AS 'nit', ingOp.fechaRealIng AS 'fReal', ingOp.fechaRegistro AS 'fRegistro', nt.nombreEmpresa AS 'empresa', ingOp.numeroIngreso AS 'ingreso', ingOp.numeroPoliza AS 'poliza', ingOp.fechaRegistro AS 'fechaOp', 
ingOp.bultos AS 'blts', ingOp.totalValorCif AS 'cif', ingOp.valorImpuesto AS 'impts' 
FROM INGOPERACIONES ingOp
INNER JOIN NIT nt ON nt.id = ingOp.idNit AND fechaRegistro BETWEEN @fechaInicio AND @fechaFin AND ingOp.estadoIngreso=2
ORDER BY ingOp.numeroIngreso

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarIngBodOp]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMostrarIngBodOp]


AS
BEGIN
	SET NOCOUNT ON;

SELECT nt.nitEmpresa AS 'nit', ingOp.id AS 'ident', nt.nitEmpresa AS 'nit', ingOp.fechaRealIng AS 'fReal', ingOp.fechaRegistro AS 'fRegistro', nt.nombreEmpresa AS 'empresa', ingOp.numeroIngreso AS 'ingreso', ingOp.numeroPoliza AS 'poliza', ingOp.fechaRegistro AS 'fechaOp', 
ingOp.bultos AS 'blts', ingOp.totalValorCif AS 'cif', ingOp.valorImpuesto AS 'impts' 
FROM INGOPERACIONES ingOp
INNER JOIN NIT nt ON nt.id = ingOp.idNit AND ingOp.estadoIngreso=2 
ORDER BY ingOp.numeroIngreso

END

GO
/****** Object:  StoredProcedure [dbo].[spMostrarLineas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMostrarLineas]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT mdVeh.id AS 'idMedida', tpVeh.tipoVehiculo AS 'tipoVeh', mdVeh.linea AS 'lineaVeh' FROM medidasVehiculos mdVeh
INNER JOIN tiposDeVehiculos tpVeh ON tpVeh.id = mdVeh.idTipoVeh


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarNit]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMostrarNit]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM nit

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarNitOP]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMostrarNitOP]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

	SELECT * FROM nit WHERE id = @valor
END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarNitOPB]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMostrarNitOPB]

@valor text

	AS
BEGIN
	SET NOCOUNT ON;
SELECT 
nit.id AS 'idNitEmp', nit.nitEmpresa, nit.nombreEmpresa, nit.direccionEmpresa,

ISNULL(usx.id,0) as 'idUs', usx.contacto AS 'nombreContacto', usx.telefono AS 'telefonoContacto', usx.email AS 'CorreoContacto', usx.ejecutivoVentas AS 'numEjecutivo', usx.id AS 'numCliente', usx.numeroTarifa AS 'numeroTarifa',

ISNULL(personal.id,0) AS 'idPer', personal.nombres AS 'usuarioNom', personal.apellidos AS 'usuarioAp', dep.departamentos AS 'depto', personal.email AS 'correoEjecutivo', personal.telefono AS 'telefonoEjecutivo' 

FROM nit 
LEFT JOIN usuariosExternos usx ON usx.idNit = nit.id 
LEFT JOIN personal ON personal.id = usx.ejecutivoVentas 
LEFT JOIN departamentos dep ON personal.departamento = dep.id
WHERE nit.nitEmpresa  LIKE @valor

END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarPen]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spMostrarPen]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;
SELECT count(*) AS 'cantIng' FROM ingresoOperacionFiscal WHERE identBodega = @valor and estadoIngreso = 2
END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarPoliza]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO











CREATE PROCEDURE [dbo].[spMostrarPoliza]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @polRet VARCHAR(50)
SET @polRet = (SELECT polizaRetiro FROM retiroOperacionFiscal WHERE id = @valor)
 
DECLARE @idCalc INT
SET @idCalc = (SELECT ISNULL(id,0) FROM calculosNormal WHERE poliza like @polRet)

SELECT @polRet AS 'poliza', @idCalc AS 'idCalc'

END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarSerAcuse]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spMostrarSerAcuse]
@idOpera int,
@tipoOp int

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM serviciosDefExtras GTODescarga
INNER JOIN otrosServicios ser ON GTODescarga.idServicio = ser.id 
where idTipoTran = @idOpera and tipoTran = @tipoOp

END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarSerTar]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO











CREATE PROCEDURE [dbo].[spMostrarSerTar]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
ALM.idServicio,
ALM.idTarifa, 
SER.servicio, 
ALM.calculoSobre
FROM servicios SER, ALMACENAJES ALM 
WHERE 
ALM.idServicio=SER.id AND idUsuarioCliente = 3 AND ALM.aplicaServicio=1


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarServicios3]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spMostrarServicios3]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;
SELECT 
SERVI.servicio, AL.idTarifa AS 'claveAlmacenaje', 
SG.idSeguro AS 'claveSeguro', 
MN.idManejo AS 'claveManejo', 
GSTAD.idgastosAdmin AS 'claveGtosAdmin', 
OTROS.idotrosGastos AS 'claveOtrosGtos',
USC.estadoTarifa AS 'estadoTarifa'
FROM ALMACENAJES AL
INNER JOIN usuariosExternos USC ON AL.idUsuarioCliente = USC.id AND USC.id=@valor
LEFT JOIN seguro SG ON AL.idUsuarioCliente=SG.idUsuarioCliente AND SG.idUsuarioCliente=@valor AND SG.idTarifa=AL.idTarifa  AND SG.aplicaServicio=1
LEFT JOIN manejo MN ON AL.idUsuarioCliente=MN.idUsuarioCliente AND MN.idUsuarioCliente=@valor AND MN.idTarifa=AL.idTarifa AND MN.aplicaServicio=1
LEFT JOIN GASTOS_ADMIN GSTAD ON AL.idUsuarioCliente=GSTAD.idUsuarioCliente AND GSTAD.idUsuarioCliente=@valor AND GSTAD.idTarifa=AL.idTarifa AND GSTAD.aplicaServicio=1
LEFT JOIN OTROS_GASTOS OTROS ON AL.idUsuarioCliente=OTROS.idUsuarioCliente AND OTROS.idUsuarioCliente=@valor AND OTROS.idTarifa=AL.idTarifa AND OTROS.aplicaServicio=1
INNER JOIN servicios SERVI ON AL.idServicio=SERVI.id;
END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarServicios4]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spMostrarServicios4]
	@valor int,
	@aplicaServicio int
AS
BEGIN
	SET NOCOUNT ON;

UPDATE USUARIOCLIENTE
SET estadoTarifa=2
WHERE id=@valor

SELECT SERVI.servicio, AL.idTarifa AS "claveAlmacenaje", SG.idSeguro AS "claveSeguro", MN.idManejo AS "claveManejo", GSTAD.idgastosAdmin AS "claveGtosAdmin", OTROS.idotrosGastos AS "claveOtrosGtos", AL.aplicaServicio AS "Anulado"
FROM ALMACENAJES AL
INNER JOIN USUARIOSEXTERNOS USC ON AL.idUsuarioCliente = USC.id AND USC.id=@valor AND AL.aplicaServicio=@aplicaServicio
LEFT JOIN SEGURO SG ON AL.idUsuarioCliente=SG.idUsuarioCliente AND SG.idUsuarioCliente=@valor AND SG.idTarifa=AL.idTarifa  AND SG.aplicaServicio=@aplicaServicio
LEFT JOIN MANEJO MN ON AL.idUsuarioCliente=MN.idUsuarioCliente AND MN.idUsuarioCliente=@valor AND MN.idTarifa=AL.idTarifa AND MN.aplicaServicio=@aplicaServicio
LEFT JOIN GASTOS_ADMIN GSTAD ON AL.idUsuarioCliente=GSTAD.idUsuarioCliente AND GSTAD.idUsuarioCliente=@valor AND GSTAD.idTarifa=AL.idTarifa AND GSTAD.aplicaServicio=@aplicaServicio
LEFT JOIN OTROS_GASTOS OTROS ON AL.idUsuarioCliente=OTROS.idUsuarioCliente AND OTROS.idUsuarioCliente=@valor AND OTROS.idTarifa=AL.idTarifa AND OTROS.aplicaServicio=@aplicaServicio
INNER JOIN SERVICIOS SERVI ON AL.idServicio=SERVI.id;END



GO
/****** Object:  StoredProcedure [dbo].[spMostrarSumDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spMostrarSumDet]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'sumaIncidencias' FROM INCIDENCIAS WHERE idDetalle = @valor


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarSumMer]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spMostrarSumMer]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'sumaMerca' FROM detalleDeMercaderia WHERE idIngreso = @valor AND estado <> 3


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarTodo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spMostrarTodo]
	@numeroCliente int,
	@numeroTarifa int
AS
BEGIN
	SET NOCOUNT ON;

SELECT SERVI.servicio, USC.numeroTarifa, AL.baseCalculo AS 'Base de Calculo Almacenaje', AL.calculoSobre AS 'calculoSobre Almacenaje', 
AL.periodoCalculo AS 'PeriodoCalculo Almacenaje', AL.Moneda AS 'Moneda Almacenaje', AL.valorTarifa AS 'Valor Almacenaje',  
SG.periodSeguro AS 'Calculo Sobre Seguro', SG.baseSeguro AS 'Base seguro', SG.periodoCalculo AS 'Periodo calculo seguro', SG.monedaCalculo AS 'Moneda Seguro', SG.valorSeguro AS 'Valor seguro',
MN.baseManejo AS 'Base manejo', MN.monedaCalculo AS 'Moneda Calculo manejo', MN.valorManejo AS 'Valor manejo', 
GSTAD.basegastosAdmin AS 'Base Gastos Admin', GSTAD.monedaCalculo AS 'Moneda Gastos Admin', GSTAD.valorgastosAdmin AS 'Valor Gastos Admin', 
OTROS.baseotrosGastos AS 'Base otros gastos', OTROS.monedaCalculo AS 'Moneda otros gastos', OTROS.valorotrosGastos AS 'Valor otros gastos'

FROM ALMACENAJES AL
INNER JOIN USUARIOSEXTERNOS USC ON AL.idUsuarioCliente = USC.id AND USC.id=@numeroCliente AND AL.aplicaServicio=1 AND AL.numeroSerie=@numeroTarifa
LEFT JOIN SEGURO SG ON AL.idUsuarioCliente=SG.idUsuarioCliente AND SG.idUsuarioCliente=@numeroCliente AND SG.idTarifa=AL.idTarifa AND SG.aplicaServicio=1 AND SG.numeroSerie=@numeroTarifa
LEFT JOIN MANEJO MN ON AL.idUsuarioCliente=MN.idUsuarioCliente AND MN.idUsuarioCliente=@numeroCliente AND MN.idTarifa=AL.idTarifa AND MN.aplicaServicio=1 AND MN.numeroSerie=@numeroTarifa
LEFT JOIN GASTOS_ADMIN GSTAD ON AL.idUsuarioCliente=GSTAD.idUsuarioCliente AND GSTAD.idUsuarioCliente=@numeroCliente AND GSTAD.idTarifa=AL.idTarifa AND GSTAD.aplicaServicio=1 AND GSTAD.numeroSerie=@numeroTarifa
LEFT JOIN OTROS_GASTOS OTROS ON AL.idUsuarioCliente=OTROS.idUsuarioCliente AND OTROS.idUsuarioCliente=@numeroCliente AND OTROS.idTarifa=AL.idTarifa AND OTROS.aplicaServicio=1 AND OTROS.numeroSerie=@numeroTarifa
INNER JOIN SERVICIOS SERVI ON AL.idServicio=SERVI.id;


END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarTotalesConta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMostrarTotalesConta]
@ident int

AS
BEGIN
	SET NOCOUNT ON;

SELECT ISNULL(SUM(valIng.totalValorCif), 0) AS 'sumCif', ISNULL(SUM(valIng.valorImpuesto),0) AS 'sumImpuesto' FROM ingresoOperacionFiscal ingOp  
INNER JOIN valoresIngOpFiscal valIng ON  valIng.idIngreso = ingOp.id
where ingOp.estadoIngreso = 5 AND ingOp.identBodega =  @ident

END

GO
/****** Object:  StoredProcedure [dbo].[spMostrarUbicacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spMostrarUbicacion]
	@idDet int

AS
BEGIN
	SET NOCOUNT ON;


select ubicaciones.id, ubicaciones.pasY, ubicaciones.ColX, incidencia.descripcionMercaderia from detalleDeMercaderia
inner join incidencia ON incidencia.idDetalle = detalleDeMercaderia.id and detalleDeMercaderia.id=@idDet
inner join ubicaciones ON ubicaciones.idIncidencia = incidencia.id


END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarUsuario]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMostrarUsuario]
@idUsuario int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
per.id,
usuarios AS 'usuario', 
per.contra,
nombres AS 'nombre', 
apellidos,
per.fecha_creacion,
per.telefono,
per.email,
niv.nivelUsuario AS 'niveles',
bod.dependencia AS 'dependencia',
bod.id as 'idDeBodega',
per.foto,
per.estado,
dep.departamentos
FROM personal per
left JOIN departamentos dep ON per.departamento = dep.id
left JOIN nivelesSistema niv ON per.nivel = niv.id

left JOIN bodegas bod ON bod.id = per.dependencia
left JOIN empresas emp ON emp.id = bod.dependencia
where per.usuarios = @idUsuario


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarUsuarioEdit]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMostrarUsuarioEdit]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT 
usuarios, nombres, apellidos,
dep.departamentos AS 'funcion',
niv.nivelUsuario AS 'nivel', per.foto,
per.estado, per.id, per.email, per.telefono, per.contra
FROM personal per
INNER JOIN departamentos dep ON per.departamento = dep.id
INNER JOIN nivelesSistema niv ON per.nivel = niv.id and per.id = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spMostrarUsuarioIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spMostrarUsuarioIng]
@idIngreso int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT per.nombres, per.apellidos from bitacoraIngresos bitacora
INNER JOIN personal per ON per.id = bitacora.idUsuario and bitacora.idIngreso = @idIngreso

END

GO
/****** Object:  StoredProcedure [dbo].[spMostrarUsuarios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spMostrarUsuarios]
	AS
BEGIN
SET NOCOUNT ON;
SELECT 
per.id
FROM personal per
left JOIN departamentos dep ON per.departamento = dep.id
left JOIN nivelesSistema niv ON per.nivel = niv.id

left JOIN bodegas bod ON bod.id = per.dependencia
left JOIN empresas emp ON emp.id = bod.dependencia


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarVehiculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMostrarVehiculo]
@idVeh int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT mdVeh.id AS 'idMedida', tpVeh.tipoVehiculo AS 'tipoVeh', mdVeh.linea AS 'lineaVeh' FROM medidasVehiculos mdVeh
INNER JOIN tiposDeVehiculos tpVeh ON tpVeh.id = mdVeh.idTipoVeh AND  mdVeh.id = @idVeh


END
GO
/****** Object:  StoredProcedure [dbo].[spMostrarVehNewCorreo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spMostrarVehNewCorreo]
	@idGrp int
AS
BEGIN
	SET NOCOUNT ON;


SELECT nit.nitEmpresa, nit.nombreEmpresa, chas.chasis, med.linea, tp.tipoVehiculo, tras.id FROM trasladoFiscalVeh tras
INNER JOIN retiroOperacionFiscal ret ON ret.id = tras.idRet
INNER JOIN ingresoOperacionFiscal ing ON ing.id = ret.idIngresosOP
INNER JOIN nit ON nit.id = ing.idNit 
INNER JOIN agrupacionEmpresas agroup ON agroup.idNitVeh = ing.idNit
INNER JOIN grupoEmpresas grp ON grp.id = agroup.idEmpGp
INNER JOIN chasisVehiculosNuevos chas ON chas.id = tras.chasis
INNER JOIN medidasVehiculos med ON med.id = chas.lineaVehiculo
INNER JOIN tiposDeVehiculos tp ON tp.id = chas.tipoVehiculo
where tras.estado = 1

END


GO
/****** Object:  StoredProcedure [dbo].[spMostVeFina]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spMostVeFina]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT chasVN.id AS'identyChasis', ISNULL(mdV.anchoMts,0) AS 'medidaVehiculo', tipV.tipoVehiculo AS 'tipoV',
mdV.linea AS 'lineaV', chasVN.chasis AS 'chasisVe', chasVN.estado AS 'estadoVeh', 
ISNULL(chasVN.ubicacion, 0) AS 'ubica'
FROM chasisVehiculosNuevos chasVN
INNER JOIN medidasVehiculos mdV on chasVN.lineaVehiculo = mdV.id AND chasVN.idIngreso = @valor
INNER JOIN tiposDeVehiculos tipV on tipV.id = chasVN.tipoVehiculo   

END


GO
/****** Object:  StoredProcedure [dbo].[spMstAjustesConta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spMstAjustesConta]
@ident int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @ident)

SELECT 
nit.nitEmpresa, ingOp .id AS 'idIng',
ingOp.numeroPoliza, convert(varchar, ingOp.fechaRegistro, 23) as 'fecha' , nit.nombreEmpresa, invent.saldoValorCif, invent.saldoValorImpuesto
, empresas.empresa, bodegas.areasAutorizadas, bodegas.numeroIdentidad

FROM ingresoOperacionFiscal ingOp 
INNER JOIN bodegas ON bodegas.id = ingOp.identBodega AND bodegas.dependencia = @dependencia
INNER JOIN empresas ON bodegas.dependencia = empresas.id
inner join inventarioFiscal invent ON invent.idIngreso = ingOp.id AND invent.saldoValorCif !=0 AND invent.saldoValorImpuesto!=0
INNER JOIN nit ON nit.id = ingOp.idNit AND invent.saldoBultos = 0 and ingOp.estadoIngreso = 5

END


GO
/****** Object:  StoredProcedure [dbo].[spMstAlmacenaje]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spMstAlmacenaje]

	@valor int
AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM ALMACENAJES WHERE idTarifa=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMstCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spMstCalculo]
	@valor text
AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM calculosNormal WHERE poliza like @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMstDependencias]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spMstDependencias]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT bod.id AS 'idBodega', bod.areasAutorizadas AS 'area', bod.numeroIdentidad AS 'numeroBodega', em.empresa AS 'nombre' FROM BODEGAS bod
INNER JOIN EMPRESAS em ON bod.dependencia = em.id 

END
GO
/****** Object:  StoredProcedure [dbo].[spMstDetalles]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spMstDetalles]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM detalleDeMercaderia WHERE idIngreso =  @valor AND estado = 0
END


GO
/****** Object:  StoredProcedure [dbo].[spMstDetBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMstDetBod]

	@valor int
AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM detalleDeMercaderia WHERE id=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMstEmpresaCoin]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spMstEmpresaCoin]
@dato text

AS
SELECT nombreEmpresa FROM NIT WHERE nombreEmpresa LIKE CONCAT (@dato,'%')

GO
/****** Object:  StoredProcedure [dbo].[spMstGtsAd]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spMstGtsAd]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

	
select * from GASTOS_ADMIN WHERE idTarifa = @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMstIngCobro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMstIngCobro]
	@idIngVal int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @posiciones int
DECLARE @metros int

SET @posiciones = (SELECT SUM(posiciones) FROM incidencia WHERE idIngreso= @idIngVal)
SET @metros = (SELECT SUM(metros) FROM incidencia WHERE idIngreso= @idIngVal)

SELECT ingop.id AS 'idIng', ingop.numeroPoliza AS 'poliza', ingop.id + 10000 AS 'ingreso', 
 convert(varchar(10),sldf.fechaRealIng,23) AS 'fIngreso', sldf.bultos AS 'blts', @posiciones AS 'pos', @metros AS 'mts', sldf.valorTotalAduana AS 'aduana',
 sldf.totalValorCif AS 'cif', sldf.valorImpuesto AS 'imputs' FROM ingresoOperacionFiscal ingop 
INNER JOIN incidencia inci ON  inci.idIngreso = ingop.id AND ingop.id= @idIngVal
INNER JOIN valoresIngOpFiscal sldf ON sldf.idIngreso = ingop.id 



END


GO
/****** Object:  StoredProcedure [dbo].[spMstManejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spMstManejo]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

select * from MANEJO WHERE idTarifa = @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMstPara]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMstPara]

	@valor int
AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM parametros WHERE codigo=@valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMstrAduana]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMstrAduana]


AS
BEGIN
	SET NOCOUNT ON;

SELECT id AS 'value', aduana AS 'origen', claveAduana AS 'clave'  FROM aduanas

END


GO
/****** Object:  StoredProcedure [dbo].[spMstrSldF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMstrSldF]

@idIngresosOP int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @pos int
DECLARE @mts float

SET @pos = (SELECT SUM(posiciones) FROM incidencia WHERE idIngreso= @idIngresosOP)
SET @mts = (SELECT SUM(metros) FROM incidencia WHERE idIngreso= @idIngresosOP)


SELECT  convert(varchar(10),sldIF.fechaRealIng,23) AS 'fechaIngreso', 
sldIF.bultos, @pos AS 'posicion', @mts AS 'metros',
 sldIF.valorTotalAduana, sldIF.totalValorCif, sldIF.valorImpuesto, ingOp.numeroPoliza, 
 sldIF.peso, sldIF.cantidadClientes
FROM valoresIngOpFiscal sldIF 
INNER JOIN ingresoOperacionFiscal ingOp ON sldIF.idIngreso = ingOp.id AND ingOp.id = @idIngresosOP


END
GO
/****** Object:  StoredProcedure [dbo].[spMstrSldFR]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spMstrSldFR]

@idIngresosOP int

	AS
BEGIN
	SET NOCOUNT ON;

	


 
SELECT convert(varchar(10),retOp.fechaEmision,23) AS 'fechaRetiro', valRet.totalValorCif AS 'cif', valRet.valorImpuesto AS 'impuesto', valRet.valorTotalAduana AS 'aduana',
valRet.bultos  AS 'blts', valRet.peso, retOp.detallesRebajados
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal valRet ON valRet.idRet =  retOp.id AND retOp.idIngresosOP = @idIngresosOP
ORDER BY convert(varchar(10),retOp.fechaEmision,23) 


END



GO
/****** Object:  StoredProcedure [dbo].[spMstSaldosBlts]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spMstSaldosBlts]

@idIng int

	AS
BEGIN
	SET NOCOUNT ON;
	

/** BULTOS REABAJADOS EN POLIZAS DI **/

DECLARE @bultosDr INT
SET @bultosDr = (
select ISNULL(SUM(valRet.bultos),0)
from valoresRetirosFiscal valRet
LEFT join valoresPolizaDR valPol ON valPol.idRet =	 valRet.idRet
INNER JOIN retiroOperacionFiscal ret  ON ret.id =  valRet.idRet
where valRet.idIngreso = @idIng AND valPol.id IS NULL 
)

DECLARE @cifDr FLOAT

SET @cifDr = (
select ISNULL(SUM(valRet.totalValorCif),0)
from valoresRetirosFiscal valRet
LEFT join valoresPolizaDR valPol ON valPol.idRet =	 valRet.idRet
INNER JOIN retiroOperacionFiscal ret  ON ret.id =  valRet.idRet
where valRet.idIngreso = @idIng AND valPol.id IS NULL 
)

DECLARE @imptsDr FLOAT
SET @imptsDr = (
select ISNULL(SUM(valRet.valorImpuesto),0)
from valoresRetirosFiscal valRet
LEFT join valoresPolizaDR valPol ON valPol.idRet =	 valRet.idRet
INNER JOIN retiroOperacionFiscal ret  ON ret.id =  valRet.idRet
where valRet.idIngreso = @idIng AND valPol.id IS NULL 
)


/** BULTOS REBAJADOS EN POLIZAS DR **/
DECLARE @bultosRetiro INT
SET @bultosRetiro = (
select ISNULL(SUM(valPol.bultos), 0) from valoresRetirosFiscal valRet
inner join valoresPolizaDR valPol ON valPol.idRet = valRet.idRet
where valPol.idIng = @idIng AND valPol.id IS NOT NULL 
)

DECLARE @cifRetiro FLOAT
SET @cifRetiro = (
select ISNULL(SUM(valPol.cif), 0) from valoresRetirosFiscal valRet
inner join valoresPolizaDR valPol ON valPol.idRet = valRet.idRet
where valPol.idIng = @idIng AND valPol.id IS NOT NULL 
)

DECLARE @imptsRetiro FLOAT
SET @imptsRetiro = (
select ISNULL(SUM(valPol.impuesto), 0) from valoresRetirosFiscal valRet
inner join valoresPolizaDR valPol ON valPol.idRet = valRet.idRet
where valPol.idIng = @idIng AND valPol.id IS NOT NULL )

/** SUMAs DE SALDOS REBAJADOS **/

DECLARE @tBltsRebajado INT
SET @tBltsRebajado =  ISNULL(SUM(@bultosDr+@bultosRetiro), 0)

DECLARE @tCifRebajado FLOAT
SET @tCifRebajado =  ISNULL(SUM(ROUND(@cifDr, 2)+ROUND(@cifRetiro,2)), 0)

DECLARE @tImptsRebajado FLOAT
SET @tImptsRebajado =  ISNULL(SUM(ROUND(@imptsDr, 2)+ROUND(@imptsRetiro,2)), 0)


/** BULTOS DE INGRESO **/
DECLARE @bultosIng INT
SET @bultosIng = (SELECT SUM(bultos) FROM valoresIngOpFiscal WHERE idIngreso = @idIng)
/** SALDO DE BULTOS Q **/
DECLARE @saldoRet INt
SET @saldoRet = ISNULL(SUM(@bultosIng-(@tBltsRebajado)),0)


/** CIF DE INGRESO **/
DECLARE @cif FLOAT
SET @cif = (SELECT isnull(SUM(totalValorCif),0) FROM valoresIngOpFiscal WHERE idIngreso = @idIng)
/** SALDO DE CIF Q **/
DECLARE @saldoCif FLOAT
SET @saldoCif = ISNULL(SUM(ROUND(@cif, 2)-(ROUND(@tCifRebajado, 2))),0)

/** IMPUESTOS DE INGRESO **/
DECLARE @impuestos FLOAT
SET @impuestos = (SELECT isnull(SUM(totalValorCif),0) FROM valoresIngOpFiscal WHERE idIngreso = @idIng)
/** IMPUESTOS DE BULTOS Q **/
DECLARE @saldoImpts FLOAT
SET @saldoImpts = ISNULL(SUM(ROUND(@impuestos, 2)-(ROUND(@tImptsRebajado,2))),0)





IF (@saldoRet>=0)
BEGIN
SELECT @saldoRet AS 'sldBultos', ROUND(@saldoCif, 2) AS 'sldCif', ROUND(@saldoImpts, 2) AS 'sldImpuesto'
/*
	* AJUSTANDO EL SALDO REAL DE INGRESO
*/

EXECUTE spStockGeneral @idIng
END
ELSE
BEGIN
SELECT 0
END


END


GO
/****** Object:  StoredProcedure [dbo].[spMstSeguro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spMstSeguro]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

select * from SEGURO WHERE idTarifa = @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spMstSuma]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spMstSuma]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;
IF	(SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso=@valor)>=1
SELECT SUM(bultos) FROM detalleDeMercaderia WHERE idIngreso=@valor
ELSE
PRINT 0
END


GO
/****** Object:  StoredProcedure [dbo].[spMstTotalBlt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spMstTotalBlt]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT bultos FROM INGOPERACIONES WHERE id=@valor
END


GO
/****** Object:  StoredProcedure [dbo].[spMstUnicaUb]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spMstUnicaUb]
@buscando text
	AS
BEGIN
	SET NOCOUNT ON;

IF(SELECT COUNT(*) FROM ingresoOperacionFiscal WHERE numeroPoliza LIKE @buscando)>=1 
BEGIN
SELECT ubica.idIncidencia AS 'Idincidencia', ubica.id AS 'idBodega', nt.nombreEmpresa AS 'consolidado', ing.id AS 'identifica',  ing.numeroPoliza AS 'poliza', deta.empresa AS 'clienteEmpresa', deta.bultos AS 'blts', deta.peso
AS 'dimPeso', inci.descripcionMercaderia AS
'detalleM', inci.posiciones AS 'pos', inci.metros AS 'mts', ubica.pasY AS 'pasillo', ubica.ColX AS 'columna'
FROM ingresoOperacionFiscal ing
INNER JOIN detalleDeMercaderia deta ON ing.id=deta.idIngreso AND ing.numeroPoliza LIKE @buscando
INNER JOIN INCIDENCIA inci ON deta.id = inci.idDetalle
INNER JOIN UBICACIONES ubica ON inci.id = ubica.idIncidencia
INNER JOIN NIT nt ON ing.idNit = nt.id
END
IF (SELECT COUNT(*) FROM ingresoOperacionFiscal ing WHERE dua LIKE	CONCAT('%',@buscando,'%'))>=1
BEGIN
SELECT ubica.idIncidencia AS 'Idincidencia', ubica.id AS 'idBodega', nt.nombreEmpresa AS 'consolidado', ing.id AS 'identifica',  ing.numeroPoliza AS 'poliza', deta.empresa AS 'clienteEmpresa', deta.bultos AS 'blts', deta.peso
AS 'dimPeso', inci.descripcionMercaderia AS
'detalleM', inci.posiciones AS 'pos', inci.metros AS 'mts', ubica.pasY AS 'pasillo', ubica.ColX AS 'columna'
FROM ingresoOperacionFiscal ing
INNER JOIN detalleDeMercaderia deta ON ing.id=deta.idIngreso AND ing.dua LIKE CONCAT('%',@buscando,'%')
INNER JOIN INCIDENCIA inci ON deta.id = inci.idDetalle
INNER JOIN UBICACIONES ubica ON inci.id = ubica.idIncidencia
INNER JOIN NIT nt ON ing.idNit = nt.id
END
IF (SELECT COUNT(*) FROM ingresoOperacionFiscal ing INNER JOIN detalleDeMercaderia dtM ON ing.id = dtM.idIngreso AND dtM.empresa LIKE CONCAT('%',@buscando,'%'))>=1
BEGIN
SELECT ubica.idIncidencia AS 'Idincidencia', ubica.id AS 'idBodega', nt.nombreEmpresa AS 'consolidado', ing.id AS 'identifica',  ing.numeroPoliza AS 'poliza', deta.empresa AS 'clienteEmpresa', deta.bultos AS 'blts', deta.peso
AS 'dimPeso', inci.descripcionMercaderia AS
'detalleM', inci.posiciones AS 'pos', inci.metros AS 'mts', ubica.pasY AS 'pasillo', ubica.ColX AS 'columna'
FROM ingresoOperacionFiscal ing
INNER JOIN detalleDeMercaderia deta ON ing.id=deta.idIngreso AND deta.empresa LIKE CONCAT('%',@buscando,'%')
INNER JOIN INCIDENCIA inci ON deta.id = inci.idDetalle
INNER JOIN UBICACIONES ubica ON inci.id = ubica.idIncidencia
INNER JOIN NIT nt ON ing.idNit = nt.id
END
IF (SELECT COUNT(*) FROM ingresoOperacionFiscal ing INNER JOIN nit ON nit.id = ing.idNit and nit.nombreEmpresa LIKE CONCAT('%',@buscando,'%'))>=1
BEGIN
SELECT ubica.idIncidencia AS 'Idincidencia', ubica.id AS 'idBodega', nt.nombreEmpresa AS 'consolidado', ing.id AS 'identifica',  ing.numeroPoliza AS 'poliza', deta.empresa AS 'clienteEmpresa', deta.bultos AS 'blts', deta.peso
AS 'dimPeso', inci.descripcionMercaderia AS
'detalleM', inci.posiciones AS 'pos', inci.metros AS 'mts', ubica.pasY AS 'pasillo', ubica.ColX AS 'columna'
FROM ingresoOperacionFiscal ing
INNER JOIN nit ON nit.id = ing.idNit and nit.nombreEmpresa LIKE CONCAT('%',@buscando,'%')
INNER JOIN detalleDeMercaderia deta ON ing.id=deta.idIngreso
INNER JOIN INCIDENCIA inci ON deta.id = inci.idDetalle
INNER JOIN UBICACIONES ubica ON inci.id = ubica.idIncidencia
INNER JOIN NIT nt ON ing.idNit = nt.id
END

ELSE
BEGIN
SELECT ubica.idIncidencia AS 'Idincidencia', ubica.id AS 'idBodega', nt.nombreEmpresa AS 'consolidado', ing.id AS 'identifica',  ing.numeroPoliza AS 'poliza', deta.empresa AS 'clienteEmpresa', deta.bultos AS 'blts', deta.peso
AS 'dimPeso', inci.descripcionMercaderia AS
'detalleM', inci.posiciones AS 'pos', inci.metros AS 'mts', ubica.pasY AS 'pasillo', ubica.ColX AS 'columna'
FROM ingresoOperacionFiscal ing
INNER JOIN detalleDeMercaderia deta ON ing.id=deta.idIngreso
INNER JOIN INCIDENCIA inci ON deta.id = inci.idDetalle
INNER JOIN UBICACIONES ubica ON inci.id = ubica.idIncidencia
INNER JOIN NIT nt ON ing.idNit = nt.id AND nt.nitEmpresa LIKE @buscando
END
END
GO
/****** Object:  StoredProcedure [dbo].[spMtsCtaContables]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spMtsCtaContables]

	AS
BEGIN
	SET NOCOUNT ON;

select * from cuentasContables

END
GO
/****** Object:  StoredProcedure [dbo].[spMuestraEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMuestraEmpresa]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM NIT

END


GO
/****** Object:  StoredProcedure [dbo].[spMuestraOtrosServicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spMuestraOtrosServicios]

AS
BEGIN
	SET NOCOUNT ON;

select id AS 'servicio', otrosServicios as 'otrosServicios' from otrosServicios

END


GO
/****** Object:  StoredProcedure [dbo].[spNAplicaTarifa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spNAplicaTarifa]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

	
  UPDATE CLIENTESSINTARIFA
  SET estado = 3, comentarios = 'No aplica tarifa'
  WHERE id = @valor

END


GO
/****** Object:  StoredProcedure [dbo].[spNewConsolidad]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spNewConsolidad]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranNewCons
declare @nombreEmp varchar(100)
set @nombreEmp = (select nombreEmpresa from nit where id = @valor)

INSERT INTO [dbo].[empresasConsolidadas]
           ([idNit]
           ,[consolidado]
           ,[estadoComision])
     VALUES
           (@valor
           ,@nombreEmp
           ,0)

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranNewCons
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranNewCons
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spNewServicio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spNewServicio]
	@servicio text,
	@estado int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranNewServ
DECLARE @revisionSer int
set @revisionSer = (SELECT count(*) FROM [otrosServicios] WHERE otrosServicios LIKE 'DIESEL ORGANICO')

IF (@revisionSer=0)
BEGIN
INSERT INTO [dbo].[otrosServicios] ([otrosServicios], [estado]) VALUES (@servicio, @estado)
END
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranNewServ
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranNewServ
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spNewServicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spNewServicios]
@idTipoTran INT, 
@idServicio INT,
@montoExtra FLOAT,
@comentarios TEXT,
@usuario INT,
@estado INT,
@tipoTran INT

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranNewSer
INSERT INTO [dbo].[serviciosDefExtras] ([idTipoTran], [idServicio], [montoExtra], [fechaRegistro], [comentarios], [usuario], [estado], [tipoTran])
VALUES
(
@idTipoTran, 
@idServicio,
@montoExtra,
GETDATE(),
@comentarios,
@usuario,
@estado,
@tipoTran)

SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranNewSer
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranNewSer
SELECT 1 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spNitEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spNitEmpresa]

	AS
BEGIN
	SET NOCOUNT ON;

select nit.nitEmpresa, nit.nombreEmpresa, nit.direccionEmpresa, ingCon.consolidado from empresasConsolidadas ingCon
inner join nit on nit.id = ingCon.idNit

END


GO
/****** Object:  StoredProcedure [dbo].[spNitIngO]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spNitIngO]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;
SELECT nit.id AS 'identy', nit.nitEmpresa AS'nt', nit.nombreEmpresa AS 'empresa', nit.direccionEmpresa AS 'direccion', per.nombres AS 'nom', per.apellidos AS 'ape', per.telefono AS 'telefono'  FROM INGOPERACION ing
INNER JOIN NIT nit ON ing.idNit  = nit.id AND ing.id=@valor
INNER JOIN USUARIOSEXTERNOS usx ON usx.idNit = ing.idNit
INNER JOIN PERSONAL per ON per.id = usx.ejecutivoVentas 
 END
GO
/****** Object:  StoredProcedure [dbo].[spNitRetiro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spNitRetiro]
	@valor text

AS
BEGIN
	SET NOCOUNT ON;

SELECT id AS 'nt', nombreEmpresa AS 'nombre', direccionEmpresa AS 'direccion' 
FROM NIT
WHERE nitEmpresa LIKE @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spNitSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spNitSalida]
@valor text

	AS
BEGIN
	SET NOCOUNT ON;


IF (SELECT COUNT(*) FROM ingresoOperacionFiscal ingrOp INNER JOIN NIT nt ON ingrOp.idNit = nt.id AND ingrOp.numeroPoliza LIKE @valor)>=1
BEGIN
SELECT
ingrOp.id AS 'idIng', ingrOp.numeroPoliza AS 'Poliza', nt.nombreEmpresa AS 'Empresa', sldf.bultos AS 'blts',
sldf.peso AS 'pesokg', ingrOp.familiaPoliza, ISNULL(inv.tipo, 'ZA') as 'tipo', ingrOp.identBodega,
bod.numeroIdentidad, empre.empresa, inv.saldoBultos, empre.id as 'empresaID'
FROM ingresoOperacionFiscal ingrOp
INNER JOIN NIT nt ON ingrOp.idNit = nt.id AND ingrOp.numeroPoliza LIKE @valor
INNER JOIN valoresIngOpFiscal sldf ON sldf.idIngreso = ingrOp.id
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingrOp.id 
INNER JOIN bodegas bod on bod.id = ingrOp.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
WHERE ingrOp.estadoIngreso >= 4

END

IF (SELECT COUNT(*) FROM ingresoOperacionFiscal ingrOp INNER JOIN nit nt ON ingrOp.idnit = nt.id  INNER JOIN valoresIngOpFiscal sldf ON sldf.idIngreso = ingrOp.id  AND sldf.peso LIKE @valor)>=1
BEGIN
SELECT 
ingrOp.id AS 'idIng', ingrOp.numeroPoliza AS 'Poliza', nt.nombreEmpresa AS 'Empresa', sldf.bultos AS 'blts',
sldf.peso AS 'pesokg', ingrOp.familiaPoliza, ISNULL(inv.tipo, 'ZA') as 'tipo', ingrOp.identBodega,
bod.numeroIdentidad, empre.empresa, inv.saldoBultos, empre.id as 'empresaID'
FROM ingresoOperacionFiscal ingrOp
INNER JOIN NIT nt ON ingrOp.idNit = nt.id
INNER JOIN valoresIngOpFiscal sldf ON sldf.idIngreso = ingrOp.id  AND sldf.peso LIKE @valor
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingrOp.id 
INNER JOIN bodegas bod on bod.id = ingrOp.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
WHERE ingrOp.estadoIngreso >= 4

END

IF (SELECT COUNT(*) FROM ingresoOperacionFiscal ingrOp INNER JOIN NIT nt ON ingrOp.idNit = nt.id AND nt.nitEmpresa LIKE @valor)>=1
BEGIN
SELECT ingrOp.id AS 'idIng', ingrOp.numeroPoliza AS 'Poliza', nt.nombreEmpresa AS 'Empresa', sldf.bultos AS 'blts',
sldf.peso AS 'pesokg', ingrOp.familiaPoliza, ISNULL(inv.tipo, 'ZA') as 'tipo', ingrOp.identBodega,
bod.numeroIdentidad, empre.empresa, inv.saldoBultos, empre.id as 'empresaID'
FROM ingresoOperacionFiscal ingrOp
INNER JOIN NIT nt ON ingrOp.idNit = nt.id AND nt.nitEmpresa LIKE @valor
INNER JOIN valoresIngOpFiscal sldf ON sldf.idIngreso = ingrOp.id 
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingrOp.id 
INNER JOIN bodegas bod on bod.id = ingrOp.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
WHERE ingrOp.estadoIngreso >= 4

END

IF (SELECT COUNT(*) FROM ingresoOperacionFiscal ingrOp INNER JOIN NIT nt ON ingrOp.idNit = nt.id AND nt.nombreEmpresa LIKE CONCAT('%',@valor,'%'))>=1
BEGIN
SELECT ingrOp.id AS 'idIng', ingrOp.numeroPoliza AS 'Poliza', nt.nombreEmpresa AS 'Empresa', sldf.bultos AS 'blts', 
sldf.peso AS 'pesokg', ingrOp.familiaPoliza, ISNULL(inv.tipo, 'ZA') as 'tipo', ingrOp.identBodega,
bod.numeroIdentidad, empre.empresa, inv.saldoBultos, empre.id as 'empresaID'
FROM ingresoOperacionFiscal ingrOp
INNER JOIN NIT nt ON ingrOp.idNit = nt.id AND nt.nombreEmpresa LIKE CONCAT('%',@valor,'%')
INNER JOIN valoresIngOpFiscal sldf ON sldf.idIngreso = ingrOp.id
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingrOp.id 
INNER JOIN bodegas bod on bod.id = ingrOp.identBodega
INNER JOIN empresas empre ON empre.id = bod.dependencia
WHERE ingrOp.estadoIngreso >= 4

END

END


GO
/****** Object:  StoredProcedure [dbo].[spNitUsuario]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spNitUsuario]


AS
BEGIN
	SET NOCOUNT ON;

SELECT usx.id AS 'idCliente', nt.nitEmpresa AS 'nitCliente' FROM USUARIOSEXTERNOS usx
INNER JOIN NIT nt ON nt.id = usx.idNit
END
GO
/****** Object:  StoredProcedure [dbo].[spNivelesUser]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spNivelesUser]


AS
BEGIN
	SET NOCOUNT ON;

SELECT id AS 'identNivel', nivelUsuario AS 'nvlUser' FROM nivelesSistema



END


GO
/****** Object:  StoredProcedure [dbo].[spNuevaEmpresa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spNuevaEmpresa]
@nitEmpresa text,
@nombreEmpresa text,
@direccionEmpresa text
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error int
BEGIN TRAN tranNit
DECLARE @estado INT
SET @estado = (SELECT COUNT(*) FROM nit WHERE nit.nitEmpresa like @nitEmpresa)
IF (@estado=0)
BEGIN

DECLARE @empRev int
SET @empRev = (SELECT ISNULL(COUNT(*), 0) FROM nit WHERE nombreEmpresa LIKE @nombreEmpresa)

DECLARE @nitRev int
SET @nitRev = (SELECT ISNULL(COUNT(*), 0) FROM nit WHERE nitEmpresa LIKE @nitEmpresa)

DECLARE @sumaNit int
SET @sumaNit = (@empRev + @nitRev)
IF (@sumaNit)>=1
SELECT 'Duplicate' AS 'respuesta'
ELSE
INSERT INTO [dbo].[nit]
           ([nitEmpresa]
           ,[nombreEmpresa]
           ,[direccionEmpresa])
     VALUES
           (@nitEmpresa
		   ,@nombreEmpresa
           ,@direccionEmpresa)
END
ELSE
BEGIN
UPDATE nit SET nitEmpresa = @nitEmpresa, nombreEmpresa = @nombreEmpresa, direccionEmpresa = @direccionEmpresa
WHERE nit.nitEmpresa like @nitEmpresa
END

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranNit
SELECT 'Error' AS 'respuesta'
END
ELSE
BEGIN
COMMIT TRAN tranNit
SELECT 'Ok' AS 'respuesta'
END


END



GO
/****** Object:  StoredProcedure [dbo].[spNuevaEmpresaGP]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spNuevaEmpresaGP]
	@idEmpGp int,
	@idNitVeh int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranNewEmpresa
INSERT INTO [dbo].[agrupacionEmpresas]
           ([idEmpGp]
           ,[idNitVeh])
     VALUES
           (@idEmpGp
           ,@idNitVeh)
SET @error = @@ERROR

IF (@error != 0)
BEGIN
ROLLBACK TRAN tranNewEmpresa
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranNewEmpresa
SELECT 1 'resp'

END


END


GO
/****** Object:  StoredProcedure [dbo].[spNuevaLinea]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spNuevaLinea]
@tipo int,
@linea text
	AS
BEGIN
	SET NOCOUNT ON;
INSERT INTO [dbo].[medidasVehiculos]
           ([idTipoVeh]
           ,[linea])
     VALUES
           (@tipo
           ,@linea)
   SELECT @@IDENTITY AS 'Identity';

END
GO
/****** Object:  StoredProcedure [dbo].[spNuevaPlaca]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spNuevaPlaca]
@placa text

AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[unidadesPlacas]
           ([placa])
     VALUES
           (@placa)

SELECT @@IDENTITY AS 'IdentityPlaca';

END



GO
/****** Object:  StoredProcedure [dbo].[spNuevaSerie0]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spNuevaSerie0]
	@nuevoDato int,
	@valorCondicion int
AS
BEGIN
	SET NOCOUNT ON;

UPDATE USUARIOSEXTERNOS
SET numeroTarifa=@nuevoDato 
WHERE id=@valorCondicion

UPDATE ALMACENAJES
SET numeroSerie=@nuevoDato 
WHERE idUsuarioCliente=@valorCondicion AND aplicaServicio!=2

UPDATE SEGURO
SET numeroSerie=@nuevoDato 
WHERE idUsuarioCliente=@valorCondicion AND aplicaServicio!=2


UPDATE MANEJO
SET numeroSerie=@nuevoDato 
WHERE idUsuarioCliente=@valorCondicion AND aplicaServicio!=2

UPDATE GASTOS_ADMIN
SET numeroSerie=@nuevoDato 
WHERE idUsuarioCliente=@valorCondicion AND aplicaServicio!=2

UPDATE OTROS_GASTOS
SET numeroSerie=@nuevoDato 
WHERE idUsuarioCliente=@valorCondicion AND aplicaServicio!=2

END


GO
/****** Object:  StoredProcedure [dbo].[spNuevoAlmacenaje]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spNuevoAlmacenaje]
@idServicio int,
@idUsuarioCliente int,
@baseCalculo text,
@calculoSobre text,
@periodoCalculo text,
@Moneda text,
@valorTarifa float,
@aplicaServicio int,
@Estado int,
@fechaCotizacion date,
@fechaInicio date,
@numeroSerie int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN nvAlm
INSERT INTO [dbo].[almacenajes]
           ([idServicio]
           ,[idUsuarioCliente]
           ,[baseCalculo]
           ,[calculoSobre]
           ,[periodoCalculo]
           ,[Moneda]
           ,[valorTarifa]
           ,[aplicaServicio]
           ,[Estado]
           ,[fechaCotizacion]
           ,[fechaInicio]
           ,[numeroSerie])
     VALUES
           (@idServicio
           ,@idUsuarioCliente
           ,@baseCalculo
           ,@calculoSobre
           ,@periodoCalculo
           ,@Moneda
           ,@valorTarifa
           ,@aplicaServicio
           ,@Estado
           ,getdate()
           ,getdate()
           ,@numeroSerie)

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN nvAlm
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN nvAlm
SELECT 1 AS 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spNuevoContenedor]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spNuevoContenedor]
@contenedor text

AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[unidadesContenedores]
           ([contenedor])
     VALUES
           (@contenedor)
SELECT @@IDENTITY AS 'IdentityContenedor';

END



GO
/****** Object:  StoredProcedure [dbo].[spNuevoDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spNuevoDet]
	@idRet int,
	@nuevoDetalle text

AS
BEGIN
	SET NOCOUNT ON;
UPDATE retiroOperacionFiscal
SET detallesRebajados = @nuevoDetalle	
WHERE id = @idRet
END
GO
/****** Object:  StoredProcedure [dbo].[spNuevoDetalle]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spNuevoDetalle]
@idDetalle int,
@idRet int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @idIngreso int
SET @idIngreso = (SELECT idIngreso FROM detalleDeMercaderia WHERE id = @idDetalle)
DECLARE @retirados int
SET @retirados = (SELECT bultos FROM valoresRetirosFiscal WHERE id = @idIngreso AND estadoSaldo = 2)
DECLARE @bltsIngreso int
SET @bltsIngreso = (SELECT bultos FROM valoresIngOpFiscal WHERE id = @idIngreso)
DECLARE @nuevoSaldo int
DECLARE @retBults int
SET @retBults = ISNULL(@retirados,0)
SET @nuevoSaldo = (@bltsIngreso-@retBults)

DECLARE @posicion int
SET @posicion = (SELECT SUM(posiciones) FROM incidencia WHERE idIngreso = @idIngreso)

DECLARE @stockPos int
SET @stockPos = (SELECT ISNULL(SUM(stockPos),0) FROM incidencia WHERE idIngreso = @idIngreso)

DECLARE @retiradoPos int
SET @retiradoPos = (@posicion-@stockPos)


DECLARE @mts int
SET @mts = (SELECT SUM(metros) FROM incidencia WHERE idIngreso = @idIngreso)

DECLARE @stockMts int
SET @stockMts = (SELECT ISNULL(SUM(stockMts),0) FROM incidencia WHERE idIngreso = @idIngreso)

DECLARE @mtsRetirados int
SET @mtsRetirados = (@mts-@stockMts)

DECLARE @posUnidad int
SET @posUnidad = (SELECT posiciones FROM incidencia WHERE id = @idDetalle)

DECLARE @posMts int
SET @posMts = (SELECT metros FROM incidencia WHERE id = @idDetalle)

SELECT detMer.empresa, valRet.peso, retOP.polizaRetiro,
inc.descripcionMercaderia, ingOp.numeroPoliza, ingOp.id+10000 AS 'Ing', retOP.id+10000 AS 'Ret'
, @retBults AS 'bultosRetirados', @bltsIngreso AS 'bltsIngreso', @nuevoSaldo AS 'nuevoSaldo',
@retiradoPos AS 'PosRetirdas',  @stockPos AS 'saldoPos', @posicion AS 'ingresoPos',
@mts AS 'mtsIngresados', @mtsRetirados AS 'mtsRetirados', @stockMts AS 'stockMts',
@posUnidad AS 'posUnid',
@posMts AS 'mtsUnd'
FROM detalleDeMercaderia detMer
INNER JOIN incidencia inc ON detMer.id = inc.idDetalle AND detMer.id = @idDetalle
INNER JOIN valoresRetirosFiscal valRet ON valRet.idRet = @idRet
INNER JOIN retiroOperacionFiscal retOP ON retOP.id = valRet.idRet
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOP.idIngresosOP
INNER JOIN inventarioFiscal inven ON inven.idIngreso = ingOp.id


END
GO
/****** Object:  StoredProcedure [dbo].[spNuevoEstadoChas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spNuevoEstadoChas]
@nuevoEstado int,
@idChas int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT

BEGIN TRAN tranVeh
UPDATE chasisVehiculosNuevos
SET estado = @nuevoEstado
WHERE id = @idChas

SET @error = @@ERROR

IF (@error<>0)
BEGIN 
ROLLBACK TRAN tranVeh
SELECT 0 AS 'respUpdate'
END
ELSE
BEGIN 
COMMIT TRAN tranVeh
SELECT 1 AS 'respUpdate'
END



END

GO
/****** Object:  StoredProcedure [dbo].[spNuevoIngOPe]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spNuevoIngOPe]
@idCartaCupo text,
@numeroPoliza text,
@dua text,
@bl text,
@origenPuerto text,
@producto text,
@estadoIngreso int,
@idUsuarioCliente int,
@idNit int,
@idServicio int,
@idRegPol int,
@consolidado int,
@identBodega int,
@cantidadContenedores int,
@cantidadClientes int,
@peso float,
@bultos int,
@valorTotalAduana float,
@tipoCambio float,
@totalValorCif float,
@valorImpuesto float,
@fechaRealIng datetime,
@comentarios text,
@idUsuario int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranIng
	
DECLARE @familia INT
SET @familia = (SELECT familia FROM regimen WHERE id = @idRegPol)


DECLARE @fechaOperacion datetime
set @fechaOperacion = GETDATE()

INSERT INTO [dbo].[ingresoOperacionFiscal]
           ([idCartaCupo]
           ,[numeroPoliza]
           ,[dua]
           ,[bl]
           ,[origenPuerto]
           ,[producto]
           ,[estadoIngreso]
           ,[fechaRegistro]
           ,[idUsuarioCliente]
           ,[idNit]
		   ,[idServicio]
           ,[regimen]
		   ,[familiaPoliza]
           ,[consolidado]
           ,[identBodega])
     VALUES
           (
@idCartaCupo,
@numeroPoliza,
@dua,
@bl,
@origenPuerto,
@producto,
@estadoIngreso,
@fechaOperacion,
@idUsuarioCliente,
@idNit,
@idServicio,
@idRegPol,
@familia,
@consolidado,
@identBodega


)

DECLARE @keyIng int
SET @keyIng =  @@IDENTITY

INSERT INTO [dbo].[valoresIngOpFiscal]
           ([idIngreso]
           ,[cantidadContenedores]
           ,[cantidadClientes]
           ,[peso]
           ,[bultos]
           ,[valorTotalAduana]
           ,[tipoCambio]
           ,[totalValorCif]
           ,[valorImpuesto]
           ,[estadoSaldo]
           ,[fechaRealIng])
     VALUES
           (
@keyIng,
@cantidadContenedores,
@cantidadClientes,
@peso,
@bultos,
@valorTotalAduana,
@tipoCambio,
@totalValorCif,
@valorImpuesto,
@estadoIngreso,
@fechaRealIng
		   )


EXECUTE spClienteSinT @keyIng, @identBodega, @idNit, @idUsuario, 0
SET @error = @@ERROR
	IF (@error<>0)
	BEGIN
		ROLLBACK TRAN tranIng
		SELECT 0  AS 'Identity'
		END
	ELSE
	BEGIN
		COMMIT TRAN  tranIng
		SELECT @keyIng AS 'Identity'
	END

END


GO
/****** Object:  StoredProcedure [dbo].[spNuevoIngOPeCarga]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spNuevoIngOPeCarga]
@idCartaCupo text,
@numeroPoliza text,
@dua text,
@bl text,
@origenPuerto text,
@producto text,
@estadoIngreso int,
@idUsuarioCliente int,
@idNit int,
@idServicio int,
@idRegPol int,
@consolidado int,
@identBodega int,
@cantidadContenedores int,
@cantidadClientes int,
@peso float,
@bultos int,
@valorTotalAduana float,
@tipoCambio float,
@totalValorCif float,
@valorImpuesto float,
@fechaRealIng text,
@comentarios text,
@idUsuario int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranIng



declare @cad varchar(30)
SET @cad = '01/07/2009 12:00:10.000 AM'

DECLARE @convertFecha datetime
set @cad = substring(@cad, 7, 4) + '/' + substring(@cad, 4, 2) + '/' + substring(@cad, 1, 2) + ' ' + substring(@cad, 11, 16)



set @convertFecha =  cast(@cad as datetime)

DECLARE @familia INT
SET @familia = (SELECT familia FROM regimen WHERE id = @idRegPol)


DECLARE @fechaOperacion datetime
set @fechaOperacion = GETDATE()

INSERT INTO [dbo].[ingresoOperacionFiscal]
           ([idCartaCupo]
           ,[numeroPoliza]
           ,[dua]
           ,[bl]
           ,[origenPuerto]
           ,[producto]
           ,[estadoIngreso]
           ,[fechaRegistro]
           ,[idUsuarioCliente]
           ,[idNit]
		   ,[idServicio]
           ,[regimen]
		   ,[familiaPoliza]
           ,[consolidado]
           ,[identBodega])
     VALUES
           (
@idCartaCupo,
@numeroPoliza,
@dua,
@bl,
@origenPuerto,
@producto,
@estadoIngreso,
@fechaOperacion,
@idUsuarioCliente,
@idNit,
@idServicio,
@idRegPol,
@familia,
@consolidado,
@identBodega


)

DECLARE @keyIng int
SET @keyIng =  @@IDENTITY

INSERT INTO [dbo].[valoresIngOpFiscal]
           ([idIngreso]
           ,[cantidadContenedores]
           ,[cantidadClientes]
           ,[peso]
           ,[bultos]
           ,[valorTotalAduana]
           ,[tipoCambio]
           ,[totalValorCif]
           ,[valorImpuesto]
           ,[estadoSaldo]
           ,[fechaRealIng])
     VALUES
           (
@keyIng,
@cantidadContenedores,
@cantidadClientes,
@peso,
@bultos,
@valorTotalAduana,
@tipoCambio,
@totalValorCif,
@valorImpuesto,
@estadoIngreso,
@convertFecha
		   )


EXECUTE spClienteSinT @keyIng, @identBodega, @idNit, @idUsuario, 0
SET @error = @@ERROR
	IF (@error<>0)
	BEGIN
		ROLLBACK TRAN tranIng
		SELECT 0  AS 'Identity'
		END
	ELSE
	BEGIN
		COMMIT TRAN  tranIng
		SELECT @keyIng AS 'Identity'
	END

END


GO
/****** Object:  StoredProcedure [dbo].[spNuevoMapa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spNuevoMapa]
@idAreasAlmacenadoras int,
@pasY int,
@pasX int,
@fechaCreacion datetime
	AS
BEGIN
	SET NOCOUNT ON;


INSERT INTO [dbo].[MAPEOAREAS]
           ([idAreasAlmacenadoras]
           ,[pasY]
           ,[colX]
           ,[fechaCreacion])
     VALUES
	(
@idAreasAlmacenadoras,
@pasY,
@pasX,
@fechaCreacion
	)

SELECT @@IDENTITY AS 'Identity';


		  



END


GO
/****** Object:  StoredProcedure [dbo].[spNuevoMarchamo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spNuevoMarchamo]
@idPlt int,
@marchamo text,
@usuario int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranMarchamo

UPDATE datosUnidades
SET marchamo = @marchamo, estado = 2
WHERE id = @idPlt

/*LA FECHA ES UN PARAMETRO DE BITACORA, YA QUE SINO SE MANDA GENERA UN ERROR EL STORE PRODUCE*/
DECLARE @fecha DATETIME
SET @fecha = GETDATE()
EXECUTE spBitacoraRet @idPlt, 'Marchamo Retiro', @usuario,  1, @fecha;	


SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranMarchamo
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranMarchamo
SELECT 1 'resp'
END
END
GO
/****** Object:  StoredProcedure [dbo].[spNuevoRetBlt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spNuevoRetBlt]
@idIngreso int,
@idRet int,
@bultos int,
@peso float,
@tipoCambio float,
@valorTotalAduana float,
@totalValorCif float,
@valorImpuesto float,
@estadoSaldo int
AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[valoresRetirosFiscal]
           ([idIngreso]
           ,[idRet]
           ,[bultos]
           ,[peso]
           ,[tipoCambio]
           ,[valorTotalAduana]
           ,[totalValorCif]
           ,[valorImpuesto]
           ,[estadoSaldo])
     VALUES
           (
            @idIngreso
           ,@idRet
           ,@bultos
           ,@peso
           ,@tipoCambio
           ,@valorTotalAduana
           ,@totalValorCif
           ,@valorImpuesto
           ,@estadoSaldo
           )

		   
		   SELECT @@IDENTITY AS 'Identity';
END


GO
/****** Object:  StoredProcedure [dbo].[spNuevoSaldo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spNuevoSaldo]
	@valor int,
	@corte datetime,
	@nueva datetime

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idIngSaldo int
SET @idIngSaldo = (SELECT TOP (1) sldC.id FROM SALDOS_COBROS sldC WHERE sldC.idIngreso = @valor AND sldC.estadoSaldo = 1 ORDER BY sldC.estadoSaldo DESC)

DECLARE @peso float
DECLARE @bultos int
DECLARE @aduanaDolar float
DECLARE @cif float
DECLARE @impuestos float
DECLARE @ingPeso float
DECLARE @ingBultos int
DECLARE @ingAduanaDolar float
DECLARE @ingCif float
DECLARE @ingImpuestos float
DECLARE @idIng int
	 
SET @bultos = (SELECT SUM(bultos) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(10),sdlRet.fechaRetiro,23) = convert(varchar(10),@corte,23))
SET @peso = (SELECT SUM(peso) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(10),sdlRet.fechaRetiro,23) = convert(varchar(10),@corte,23))
SET @aduanaDolar = (SELECT SUM(valorTotalAduana) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(10),sdlRet.fechaRetiro,23) = convert(varchar(10),@corte,23))
SET @cif = (SELECT SUM(totalValorCif) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(10),sdlRet.fechaRetiro,23) = convert(varchar(10),@corte,23))
SET @impuestos = (SELECT SUM(valorImpuesto) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(10),sdlRet.fechaRetiro,23) = convert(varchar(10),@corte,23))

SET @idIng = (SELECT TOP(1) sldf.idIngreso FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso =1 ORDER BY sldf.id)
SET @ingPeso = (SELECT saldoC.peso-@peso FROM SALDOS_COBROS saldoC WHERE id=@idIngSaldo)
SET @ingBultos = (SELECT saldoC.bultos-@bultos FROM SALDOS_COBROS saldoC WHERE id=@idIngSaldo)
SET @ingAduanaDolar = (SELECT saldoC.valorTotalAduana-@aduanaDolar FROM SALDOS_COBROS saldoC WHERE id=@idIngSaldo)
SET @ingCif = (SELECT saldoC.totalValorCif-@cif FROM SALDOS_COBROS saldoC WHERE id=@idIngSaldo)
SET @ingImpuestos = (SELECT saldoC.valorImpuesto-@impuestos FROM SALDOS_COBROS saldoC WHERE id=@idIngSaldo)

INSERT INTO [dbo].[SALDOS_COBROS] 
([idIngreso], [cantidadContenedores], [cantidadClientes], [peso], [bultos], [valorTotalAduana], [tipoCambio], [totalValorCif],[valorImpuesto],[totalPosiciones], [totalMetros], [estadoSaldo], [tipoOperacion], [idRetiros],[fechaInicio], [fechaCorte])
VALUES 
(@idIng, 0, 0, @ingPeso, @ingBultos, @ingAduanaDolar, 0, @ingCif,@ingImpuestos, 0, 0, 1, 2, '0', @nueva, @nueva)

UPDATE SALDOS_COBROS
SET estadoSaldo = 2, fechaCorte = @corte
WHERE id = @idIngSaldo
END
GO
/****** Object:  StoredProcedure [dbo].[spNuevoSaldoDetalle]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spNuevoSaldoDetalle]
@idDetalle int,
@bultosNew int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN guardarDetalle


UPDATE detalleDeMercaderia
SET stock = @bultosNew
WHERE id = @idDetalle

SET @error = @@ERROR

IF (@error<>0)
BEGIN
ROLLBACK TRAN guardarDetalle
SELECT 0 AS 'estado'
END
ELSE
BEGIN 
COMMIT TRAN guardarDetalle
SELECT 1 AS 'estado'
END




END


GO
/****** Object:  StoredProcedure [dbo].[spNuevoTipoV]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spNuevoTipoV]
@tipo text

	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[tiposDeVehiculos]
           ([tipoVehiculo])
     VALUES
           (@tipo)

   SELECT @@IDENTITY AS 'Identity';

END



GO
/****** Object:  StoredProcedure [dbo].[spNuevoUsados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spNuevoUsados]

@idIngreso int,
@idDet int,
@tipo text,
@marcaVehiculo text,
@lineaVehiculo text,
@modeloVehiculo text

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
BEGIN TRAN tranIngVUsado

INSERT INTO [dbo].[vehiculosUsados]
           ([idIngreso]
           ,[idDetalle]
           ,[tipoVehiculo]
           ,[marcaVehiculo]
           ,[lineaVehiculo]
           ,[modeloVehiculo])
     VALUES
           (@idIngreso
           ,@idDet
           ,@tipo
           ,@marcaVehiculo
           ,@lineaVehiculo
           ,@modeloVehiculo)
set @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranIngVUsado
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranIngVUsado
SELECT 0 'resp'
END

END
GO
/****** Object:  StoredProcedure [dbo].[spNuevoV]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spNuevoV]

@idIngreso int,
@chasis text,
@tipo text,
@linea text

	AS
BEGIN
	SET NOCOUNT ON;


	
DECLARE @idTipo int 
SET @idTipo = (SELECT id FROM tiposDeVehiculos WHERE tipoVehiculo like @tipo)


DECLARE @idLinea int 
SET @idLinea = (SELECT mdV.id FROM medidasVehiculos mdV 
INNER JOIN tiposDeVehiculos tpV ON tpV.id = mdV.idTipoVeh AND mdV.linea LIKE @linea AND mdV.idTipoVeh = @idTipo)



INSERT INTO [dbo].[chasisVehiculosNuevos]
           ([idIngreso]
           ,[chasis]
           ,[tipoVehiculo]
           ,[lineaVehiculo]
           ,[estado])
     VALUES
           (@idIngreso
           ,@chasis
           ,@idTipo
           ,@idLinea
           ,0)



END
GO
/****** Object:  StoredProcedure [dbo].[spNumPolizas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spNumPolizas]
@date date
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranNumPoliza
DECLARE @dateCount INT

SET @dateCount = (SELECT COUNT(*) FROM correaltivoPoliza WHERE fecha = @date AND estado = 1)

IF (@dateCount=0)
BEGIN
declare @proximo_numero int 
DECLARE @revNum INT
SET @revNum = (SELECT ISNULL(COUNT(*),0)  FROM numPolizaFiscal)

IF (@revNum=0)
BEGIN
INSERT numPolizaFiscal VALUES (1)
set @proximo_numero = 1
END
ELSE
BEGIN
UPDATE numPolizaFiscal SET @proximo_numero = ultimoNumero = ultimoNumero + 1
END

INSERT correaltivoPoliza VALUES (@proximo_numero, @date, 0)


SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranNumPoliza
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranNumPoliza
SELECT @proximo_numero 'resp'
END
END

END
GO
/****** Object:  StoredProcedure [dbo].[spNumRecibo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spNumRecibo]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @numRec int
SET @numRec = SUM(10000 + @valor)

UPDATE DETALLESRECIBOS
SET numeroRecibo = @numRec

WHERE id = @valor 

END


GO
/****** Object:  StoredProcedure [dbo].[spNvCliente]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spNvCliente]
		   @nombres text,
           @apellidos text,
           @usuarios int,
           @contra text,
           @dpi text,
           @telefono int,
           @email text,
           @emailEncriptado text,
           @preguntaSecreta text,
           @respuesta text,
           @razonSocial text,
           @nombreComercial text,
           @direccionFiscal text,
           @direccionDeRecibos text,
           @nit text,
           @contacto text,
           @foto text,
           @estado int,
           @ultimo_login datetime,
           @fecha_creacion datetime,
           @estadoTarifa int,
           @ejecutivoVentas int,
           @intentos int,
           @numeroTarifa int,
           @idNit int

AS
BEGIN
	SET NOCOUNT ON;


INSERT INTO [dbo].[USUARIOSEXTERNOS]
           ([nombres]
           ,[apellidos]
           ,[usuarios]
           ,[contra]
           ,[dpi]
           ,[telefono]
           ,[email]
           ,[emailEncriptado]
           ,[preguntaSecreta]
           ,[respuesta]
           ,[razonSocial]
           ,[nombreComercial]
           ,[direccionFiscal]
           ,[direccionDeRecibos]
           ,[nit]
           ,[contacto]
           ,[foto]
           ,[estado]
           ,[ultimo_login]
           ,[fecha_creacion]
           ,[estadoTarifa]
           ,[ejecutivoVentas]
           ,[intentos]
           ,[numeroTarifa]
           ,[idNit])
     VALUES


(@nombres,
@apellidos,
@usuarios,
@contra,
@dpi,
@telefono,
@email,
@emailEncriptado,
@preguntaSecreta,
@respuesta,
@razonSocial,
@nombreComercial,
@direccionFiscal,
@direccionDeRecibos,
@nit,
@contacto,
@foto,
@estado,
@ultimo_login,
@fecha_creacion,
@estadoTarifa,
@ejecutivoVentas,
@intentos,
@numeroTarifa,
@idNit)


END


GO
/****** Object:  StoredProcedure [dbo].[spOtrosGastosRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spOtrosGastosRet]
	@idRet int

AS
BEGIN
	SET NOCOUNT ON;

select 
otrSer.otrosServicios, cbOtros.rubroOtrosGastos
from retiroOperacionFiscal retF
LEFT JOIN cobroOtrosGastos cbOtros ON cbOtros.idRetiro = retF.id
left join otrosServicios otrSer ON otrSer.id = cbOtros.idOtroGst 
WHERE retF.id = @idRet

END


GO
/****** Object:  StoredProcedure [dbo].[spOtrosServicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spOtrosServicios]
	@idCalculo int,
	@idServicio int, 
	@tipo int	

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM serviciosExtrasPrestados WHERE idCalculo = @idCalculo AND idServicio = @idServicio AND tipo = @tipo

END


GO
/****** Object:  StoredProcedure [dbo].[spPaseSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spPaseSalida]
	@idUnidad int,
	@idUsuario int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranBitacoraPvacio
INSERT INTO [dbo].[pasesDeSalida]
           ([idUnidad])
     VALUES
           (@idUnidad)
DECLARE @indetyTran INT
SET @indetyTran = @@IDENTITY;

EXECUTE spBitacoraIng @indetyTran, 'Pase de Salida Vacio', @idUsuario, 0
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranBitacoraPvacio
SELECT 0 'Identity'
END
ELSE
BEGIN
COMMIT TRAN tranBitacoraPvacio
SELECT @indetyTran 'Identity'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spPaseSalidaCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spPaseSalidaCalc]

@idBodega INT
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

SELECT 
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet'
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND (retOp.estadoRet >= 2) and (retOp.estadoRet <=3)
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 

END
GO
/****** Object:  StoredProcedure [dbo].[spPaseSalidaVehN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spPaseSalidaVehN]

@idBodega INT

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

SELECT 
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet'
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND retOp.estadoRet = 1
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio AND retOp.detallesRebajados LIKE 'VEHICULOS NUEVOS'

END
GO
/****** Object:  StoredProcedure [dbo].[spPiloto]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spPiloto]
	@valor text

AS
BEGIN
	SET NOCOUNT ON;


SELECT plt.id AS 'pltId', plt.piloto AS 'nombrePLT', plt.licencia AS 'licPLT'  FROM pilotos plt WHERE licencia LIKE @valor



END


GO
/****** Object:  StoredProcedure [dbo].[spPilotosCont]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spPilotosCont]
	@idIng int
AS
BEGIN
	SET NOCOUNT ON;

	select COUNT(*) AS 'conteoIng' from ingresosConsolidadoPoliza WHERE idIngreso = @idIng

END


GO
/****** Object:  StoredProcedure [dbo].[spPilotosUnidades]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spPilotosUnidades]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @idIngreso int
	SET @idIngreso = @valor

	DECLARE @inci int
	SET @inci = (SELECT COUNT(*) FROM incidencia WHERE idIngreso = @idIngreso)

	DECLARE @detalle int
	SET @detalle = (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso = @idIngreso)

	DECLARE @diferencia int
	SET @diferencia = (@detalle-@inci)

DECLARE @spDatoVinculo int
SET @spDatoVinculo = (SELECT id FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIngreso AND tipoOperacion = 1)

SELECT unidades.id AS 'operacion', ingPol.id AS 'idIngreso', plt.licencia, plt.piloto, unidades.marchamo, uniPlaca.placa,
uniConte.contenedor, ingPol.numeroPoliza, @spDatoVinculo AS 'idCadena', ISNULL(psSal.idUnidad, 0) AS 'unidad', ingPol.estadoIngreso AS 'estadoIngreso', @diferencia AS 'diferencia'
, unidades.estado
FROM datosUnidades unidades
INNER JOIN pilotos plt ON unidades.piloto = plt.id
INNER JOIN unidadesPlacas uniPlaca ON unidades.unidadPlaca = uniPlaca.id
INNER JOIN unidadesContenedores uniConte ON unidades.unidadContenedor = uniConte.id
INNER JOIN ingresoOperacionFiscal ingPol ON ingPol.id = unidades.idOp AND unidades.tipoOp = 1 AND unidades.idOp = @idIngreso
LEFT JOIN pasesDeSalida psSal ON psSal.idUnidad = unidades.id

END


GO
/****** Object:  StoredProcedure [dbo].[spPilotosUnidadesIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spPilotosUnidadesIng]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

	DECLARE @idIngreso int
	SET @idIngreso = (SELECT idOp FROM datosUnidades WHERE id = @valor)

	DECLARE @inci int
	SET @inci = (SELECT COUNT(*) FROM incidencia WHERE idIngreso = @idIngreso)

	DECLARE @detalle int
	SET @detalle = (SELECT COUNT(*) FROM detalleDeMercaderia WHERE idIngreso = @idIngreso)

	DECLARE @diferencia int
	SET @diferencia = (@detalle-@inci)

DECLARE @spDatoVinculo int
SET @spDatoVinculo = (SELECT id FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIngreso AND tipoOperacion = 1)

SELECT unidades.id AS 'operacion', ingPol.id AS 'idIngreso', plt.licencia, plt.piloto, unidades.marchamo, uniPlaca.placa,
uniConte.contenedor, ingPol.numeroPoliza, @spDatoVinculo AS 'idCadena', ISNULL(psSal.idUnidad, 0) AS 'unidad', ingPol.estadoIngreso AS 'estadoIngreso', @diferencia AS 'diferencia'

FROM datosUnidades unidades
INNER JOIN pilotos plt ON unidades.piloto = plt.id
INNER JOIN unidadesPlacas uniPlaca ON unidades.unidadPlaca = uniPlaca.id
INNER JOIN unidadesContenedores uniConte ON unidades.unidadContenedor = uniConte.id
INNER JOIN ingresoOperacionFiscal ingPol ON ingPol.id = unidades.idOp AND unidades.tipoOp = 1 AND unidades.idOp = @idIngreso
LEFT JOIN pasesDeSalida psSal ON psSal.idUnidad = unidades.id

END


GO
/****** Object:  StoredProcedure [dbo].[spPolizaIngreso]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spPolizaIngreso]
@valor date
	AS
BEGIN
	SET NOCOUNT ON;


	select ROUND(SUM(saldoValorCif), 2) AS 'polDefinitiva', ROUND(SUM(saldoValorImpuesto), 2) AS 'impuestosFiscales', ROUND(SUM(saldoValorCif), 2) + ROUND(SUM(saldoValorImpuesto), 2) AS 'total' from inventarioFiscal WHERE convert(varchar(10),fechaReporte,23) like @valor
/*select * from inventarioFiscal WHERE convert(varchar(10),fechaReporte,23) like '2020-02-19'
*/

END

      
GO
/****** Object:  StoredProcedure [dbo].[spPredioVeUsado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spPredioVeUsado]

	@idDetalle int
	

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia int
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = 1)


SELECT * FROM bodegas WHERE areasAutorizadas like '%PREDIO DE VEHICULOS USADOS%' and dependencia = @dependencia

END
GO
/****** Object:  StoredProcedure [dbo].[spRegistraAjustes]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRegistraAjustes]
@ident int,
@fecha date
	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO ajustesContables

SELECT 

ingOp.id,

invent.saldoValorCif AS 'sumCif',

invent.saldoValorImpuesto AS 'sumImpuesto', @fecha
FROM  inventarioFiscal invent
inner join ingresoOperacionFiscal ingOp ON invent.idIngreso = ingOp.id
where (invent.saldoBultos = 0 and invent.saldoValorCif!=0) or  (invent.saldoBultos = 0 and  invent.saldoValorImpuesto!=0) and ingOp.identBodega = @ident


UPDATE inventarioFiscal

SET inventarioFiscal.saldoValorCif = 0, inventarioFiscal.saldoValorImpuesto = 0, inventarioFiscal.saldoValorTAduana=0

FROM ingresoOperacionFiscal ingOp 
inner join inventarioFiscal invent ON invent.idIngreso = ingOp.id
where (invent.saldoBultos = 0 and invent.saldoValorCif!=0) or  (invent.saldoBultos = 0 and  invent.saldoValorImpuesto!=0) and ingOp.identBodega = @ident

END
GO
/****** Object:  StoredProcedure [dbo].[spRegistroCobroFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spRegistroCobroFiscal]
	@idDato int,
	@fechaIngreso date, 
	@fechaRetiro date



AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[registroDeCobrosFiscal]
           ([idIngreso]
           ,[fechaIngreso]
           ,[fechaRetiro]
           ,[estado]
           ,[fechaRegistro])
     VALUES
           (@idDato
           ,@fechaIngreso
           ,@fechaRetiro
           ,1
           ,GETDATE())
		   DECLARE @identEspecial int
		   SET @identEspecial = @@IDENTITY;

select @identEspecial AS 'identEspecial'

END


GO
/****** Object:  StoredProcedure [dbo].[spRegRecibo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spRegRecibo]
@idIngreso int,
@estado int,
@emision datetime

	AS
BEGIN
	SET NOCOUNT ON;



INSERT INTO [dbo].[DETALLESRECIBOS]
           ([idIngreso]
		    ,[estado]
            ,[emision]
			)
     VALUES
	 (
	 @idIngreso,	
	 @estado,
	 @emision
	 )

	    SELECT @@IDENTITY AS 'Identity';


END
GO
/****** Object:  StoredProcedure [dbo].[spRemoveChasAnt]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spRemoveChasAnt]
@valor int
AS
BEGIN
	SET NOCOUNT ON;

UPDATE chasisVehiculosNuevos
SET estado = 1, idRet = NULL
WHERE idRet = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spRepChasisNew]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRepChasisNew]

	@idBod int

AS
BEGIN
	SET NOCOUNT ON;


DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBod)


SELECT 
chasN.id AS 'idChasis',
nit.nombreEmpresa, ing.numeroPoliza, regimen.regimen, chasN.chasis,
tipo.tipoVehiculo, medida.linea, prd.predio, chasN.estado,
ISNULL(ret.id, 0) AS 'idRet', ing.id AS 'idIng', CONVERT(varchar, val.fechaRealIng, 23) AS 'fechaReal'
FROM chasisVehiculosNuevos chasN
LEFT JOIN retiroOperacionFiscal ret ON chasN.idRet = ret.id
INNER JOIN medidasVehiculos medida ON medida.id = chasN.lineaVehiculo
INNER JOIN tiposDeVehiculos tipo ON tipo.id = chasN.tipoVehiculo
INNER JOIN ingresoOperacionFiscal ing ON ing.id = chasN.idIngreso
INNER JOIN valoresIngOpFiscal val ON val.idIngreso = ing.id
INNER JOIN bodegas bod ON bod.id = ing.identBodega AND bod.dependencia = @dependencia
INNER JOIN nit ON nit.id = ing.idNit
INNER JOIN prediosDeVehiculos prd ON prd.id = chasN.ubicacion
INNER JOIN regimen ON  regimen.id = ing.regimen
WHERE chasN.estado >=1


END


GO
/****** Object:  StoredProcedure [dbo].[spReplaceValRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spReplaceValRet]
@idRetiro int,
@bultos int,
@peso float,
@tipoCambio float,
@valorTotalAduana float,

@totalValorCif float,
@valorImpuesto float
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @errror int
BEGIN TRAN tranValReplace
update valoresRetirosFiscal
set bultos = @bultos, peso = @peso, tipoCambio = @tipoCambio, valorTotalAduana = @valorTotalAduana, totalValorCif = @totalValorCif, valorImpuesto = @valorImpuesto
where idRet = @idRetiro

SET @errror = @@ERROR

IF (@errror<>0)
BEGIN
ROLLBACK TRAN tranValReplace
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranValReplace
SELECT 1 'resp'
END


END
GO
/****** Object:  StoredProcedure [dbo].[spReporteAjuste]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spReporteAjuste]
@fecha date,
@idBodega int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)


SELECT 
nit.nitEmpresa, ingOp .id AS 'idIng',
ingOp.numeroPoliza, convert(varchar, ingOp.fechaRegistro, 23) as 'fecha' , nit.nombreEmpresa, invent.saldoValorCif, invent.saldoValorImpuesto
, empresas.empresa, bodegas.areasAutorizadas, bodegas.numeroIdentidad, ajustesContables.ajusteCif, ajustesContables.ajusteImpuesto

FROM ingresoOperacionFiscal ingOp 
INNER JOIN bodegas ON bodegas.id = ingOp.identBodega AND bodegas.dependencia = @dependencia
INNER JOIN empresas ON bodegas.dependencia = empresas.id
inner join inventarioFiscal invent ON invent.idIngreso = ingOp.id and ingOp.fechaContabilidad = @fecha
inner join ajustesContables on ajustesContables.idIngreso = ingOp.id
INNER JOIN nit ON nit.id = ingOp.idNit AND invent.saldoBultos = 0

END


GO
/****** Object:  StoredProcedure [dbo].[spReporteConta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spReporteConta]
@tipoOp int,
@identB int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

IF (@tipoOp=1)
BEGIN

SELECT
ingOp.id AS 'identIng',
numIng.numeroAsignado + @numInicio AS 'numeroDeIngreso', CONVERT(VARCHAR(10), ingOp.fechaContabilidad, 111) AS 'fechaContabilidad', ingOp.numeroPoliza, regimen.regimen,
nit.nombreEmpresa, nit.nitEmpresa, valIngOp.bultos, valIngOp.totalValorCif, valIngOp.valorImpuesto, personal.nombres, personal.apellidos, ingOp.identBodega
FROM
ingresoOperacionFiscal ingOp
INNER JOIN valoresIngOpFiscal valIngOp ON ingOp.id = valIngOp.idIngreso  and ingOp.estadoIngreso = 5 
inner JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id
INNER JOIN regimen ON regimen.id = ingOp.regimen
INNER JOIN nit ON nit.id = ingOp.idNit 
LEFT JOIN bitacoraIngresos bitacora ON bitacora.idIngreso = ingOp.id AND bitacora.transaccion LIKE 'Ingreso Contabilizado'
LEFT JOIN personal ON personal.id = bitacora.idUsuario
where ingOp.identBodega = @identB order by numIng.numeroAsignado ASC
END
ELSE
BEGIN
SELECT TOP(1) personal.nombres, personal.apellidos FROM retiroOperacionFiscal  retF
INNER JOIN bitacoraRetiroCalculo bitaRet ON retF.id = bitaRet.idOpera AND retF.estadoRet = 5 AND bitaRet.tipo = 0
INNER JOIN personal ON personal.id = bitaRet.idUsuario
END
END
GO
/****** Object:  StoredProcedure [dbo].[spReporteRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spReporteRet]
	@estado int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT nt.nombreEmpresa AS 'NOMBRE CONSIGNATARIO', nt.nitEmpresa AS 'NIT CONSIGNATARIO', numRet.numeroAsignado+@numInicio AS 'No. RETIRO', numIng.numeroAsignado +@numInicio AS 'No. INGRESO',
nitIng.nitEmpresa AS 'NIT CONSOLIDADOR', nitIng.nombreEmpresa AS 'EMPRESA CONSOLIDADOR', retOp.polizaRetiro AS 'POLIZA RETIRO', retOp.regimenSalida AS 'REG. RET', ingOp.numeroPoliza AS 'POLIZA INGRESO',
regimen.regimen AS 'REG. INGRESO', saldRet.peso AS 'PESO RETIRO', saldRet.bultos AS 'BULTOS RETIRO', saldRet.totalValorCif AS 'VALOR CIF', saldRet.valorImpuesto AS 'VALOR IMPUESTO', 
srv.servicio  AS 'tipoServicio', retOp.estadoRet AS 'ESTADO RET', saldIng.cantidadClientes AS 'CLIENTES DE INGRESO', (SELECT COUNT(*) FROM retiroOperacionFiscal WHERE idIngresosOP = ingOp.id) AS 'CLIENTES RETIRADOS', 
ingOp.identBodega AS 'AREA'
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND retOp.estadoRet = @estado
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
INNER JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
inner join nit nitIng on ingOp.idNit = nitIng.id
INNER JOIN regimen ON regimen.id = ingOp.regimen



END




GO
/****** Object:  StoredProcedure [dbo].[spReportesContabilida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spReportesContabilida]
	@idBodega int,
	@fecha date,
	@tipo int


AS
BEGIN
	SET NOCOUNT ON;

IF (@tipo=0)
BEGIN
SELECT DISTINCT(bodegas.id) FROM ingresoOperacionFiscal ingF  
INNER JOIN bodegas  ON bodegas.id = ingF.identBodega AND bodegas.id = @idBodega
INNER JOIN empresas ON empresas.id = bodegas.numeroIdentidad AND ingF.fechaContabilidad = @fecha
END
IF (@tipo=1)
BEGIN
SELECT DISTINCT(bodegas.id) FROM retiroOperacionFiscal retF
INNER JOIN bodegas  ON bodegas.id = retF.idDependencia AND bodegas.id = @idBodega
INNER JOIN empresas ON empresas.id = bodegas.numeroIdentidad AND retF.fechaConta = @fecha
END
IF (@tipo=2)
BEGIN
SELECT DISTINCT(bodegas.id) FROM ajustesContables
INNER JOIN inventarioFiscal ON ajustesContables.idIngreso = inventarioFiscal.idIngreso 
INNER JOIN ingresoOperacionFiscal ingF ON ingF.id = ajustesContables.idIngreso
INNER JOIN bodegas  ON bodegas.id = ingF.identBodega AND bodegas.id = @idBodega
INNER JOIN empresas ON empresas.id = bodegas.numeroIdentidad AND ingF.fechaContabilidad =  @fecha

END
END

GO
/****** Object:  StoredProcedure [dbo].[spRespuestaUnidades]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spRespuestaUnidades]
	@licencia text,
	@placa text, 
	@contenedor text
AS
BEGIN
	SET NOCOUNT ON;
   
   DECLARE @resLic int
   DECLARE @resPlaca int
   DECLARE @resContenedor int

   SET @resLic = (SELECT COUNT(*) FROM pilotos WHERE licencia LIKE @licencia)
   SET @resPlaca = (SELECT COUNT(*) FROM unidadesPlacas WHERE placa LIKE @placa)
   SET @resContenedor = (SELECT COUNT(*) FROM unidadesContenedores WHERE contenedor LIKE @contenedor)

   DECLARE @idLic int
   DECLARE @idPlaca int
   DECLARE @idContenedor int

   SET @idLic = (SELECT top 1 (id) FROM pilotos WHERE licencia LIKE @licencia)
   SET @idPlaca = (SELECT TOP 1(id) FROM unidadesPlacas WHERE placa LIKE @placa)
   SET @idContenedor = (SELECT TOP 1(id) FROM unidadesContenedores WHERE contenedor LIKE @contenedor)


   SELECT @idLic AS 'idLicencia', @resLic AS 'respLicencia', @idPlaca AS 'idPlaca', @resPlaca AS 'respPlaca',
   @idContenedor AS 'idContenedor', @resContenedor AS 'respContenedor'


END


GO
/****** Object:  StoredProcedure [dbo].[spRetHistUltQuinientos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRetHistUltQuinientos]
@idBodega int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT TOP(500)
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-', YEAR(numRet.fechaAsignado),'-',ISNULL(numRet.numeroAsignado+@numInicio,0))) as 'numeroRetiro',

numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
convert(varchar, retOp.fechaEmision, 103) as 'emision',
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, retOp.regimenSalida, retOp.estadoRet, inv.saldoBultos
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet
INNER JOIN nit nt ON nt.id = retOp.idNit
LEFT JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP 
LEFT JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingOp.id
LEFT JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN bodegas bod on bod.id = ingOp.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
LEFT JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
ORDER  BY retOp.id DESC
END



GO
/****** Object:  StoredProcedure [dbo].[spRetiroDr]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRetiroDr]
@idIng INT
	AS
BEGIN
	SET NOCOUNT ON;


select valRet.id, valRet.idIngreso as 'idIngreso', ret.polizaRetiro, valPol.bultos, valPol.cif as 'totalValorCif', valPol.impuesto as 'valorImpuesto', ret.regimenSalida, convert(varchar, ret.fechaEmision, 105) as 'fechaRetiro' from valoresRetirosFiscal valRet
LEFT join valoresPolizaDR valPol ON valPol.idRet =	 valRet.idRet
INNER JOIN retiroOperacionFiscal ret  ON ret.id =  valRet.idRet
where valPol.idIng = @idIng AND valPol.id IS not NULL 


END
GO
/****** Object:  StoredProcedure [dbo].[spRetiroNormal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRetiroNormal]
@idIng INT
	AS
BEGIN
	SET NOCOUNT ON;

select valRet.id, valRet.idIngreso as 'idIngreso', ret.polizaRetiro, valRet.bultos, valRet.totalValorCif, valRet.valorImpuesto, ret.regimenSalida, convert(varchar, ret.fechaEmision, 105) as 'fechaRetiro' from valoresRetirosFiscal valRet
LEFT join valoresPolizaDR valPol ON valPol.idRet =	 valRet.idRet
INNER JOIN retiroOperacionFiscal ret  ON ret.id =  valRet.idRet
where valRet.idIngreso = @idIng AND valPol.id IS NULL 


END
GO
/****** Object:  StoredProcedure [dbo].[spRetiroOperacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spRetiroOperacion]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


DECLARE @idIng INT
SET @idIng= (SELECT idIngresosOP FROM retiroOperacionFiscal WHERE id = @valor)


SELECT detallesRebajados FROM retiroOperacionFiscal WHERE idIngresosOP = @idIng
end




GO
/****** Object:  StoredProcedure [dbo].[spRetirosBodP]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spRetirosBodP]
@idBodega int	

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT retOp.id AS 'idRetiro', ingOp.id AS 'idIngreso', nt.nitEmpresa AS 'nit',
nt.nombreEmpresa AS 'empresa', ingOp.numeroPoliza AS 'polizaIng',
 retOp.id+@numInicio AS 'numRetiro',
 valRet.peso AS 'peso', retOp.polizaRetiro AS 'polizaRetiro', retOp.regimenSalida AS 'regimenRet',
 valRet.bultos AS 'bultosRet', retOp.estadoRet
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal valRet ON retOp.id = valRet.idRet AND retOp.estadoRet = 1
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN nit nt ON nt.id = retOp.idNit

END




GO
/****** Object:  StoredProcedure [dbo].[spRetirosContabilizados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRetirosContabilizados]
@estadoRet int,
@ident int,
@fecha date
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT 
numRet.numeroAsignado+@numInicio AS 'numeroRetiro',
numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, personal.nombres, personal.apellidos, retOp.regimenSalida
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND retOp.estadoRet = @estadoRet
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP AND ingOp.identBodega = @ident AND retOp.fechaConta = @fecha
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.id = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
INNER JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
LEFT JOIN bitacoraRetiroCalculo bitacoraRet ON bitacoraRet.transaccion LIKE 'Retiro Contabilizado' AND bitacoraRet.idOpera = retOp.id 
LEFT JOIN personal ON bitacoraRet.idUsuario = personal.id 


END



GO
/****** Object:  StoredProcedure [dbo].[spRetirosHistorial]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRetirosHistorial]
@idBodega int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT 
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-', YEAR(numRet.fechaAsignado),'-',ISNULL(numRet.numeroAsignado+@numInicio,0))) as 'numeroRetiro',

numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
convert(varchar, retOp.fechaEmision, 103) as 'emision',
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, retOp.regimenSalida, retOp.estadoRet, inv.saldoBultos
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet
INNER JOIN nit nt ON nt.id = retOp.idNit
LEFT JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP 
LEFT JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingOp.id
LEFT JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN bodegas bod on bod.id = ingOp.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
LEFT JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id

END



GO
/****** Object:  StoredProcedure [dbo].[spRetirosHistorialPoliza]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRetirosHistorialPoliza]
@idBodega int,
@polizaBusca text
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @cantPolizaIng INT
SET @cantPolizaIng = (SELECT COUNT(*) FROM ingresoOperacionFiscal where numeroPoliza like @polizaBusca)

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = 1)

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)


IF (@cantPolizaIng=1)
BEGIN


SELECT retOp.fechaEmision,
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-', YEAR(numRet.fechaAsignado),'-',ISNULL(numRet.numeroAsignado+@numInicio,0))) as 'numeroRetiro',

numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
convert(varchar, retOp.fechaEmision, 103) as 'emision',
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, retOp.regimenSalida, retOp.estadoRet, inv.saldoBultos
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet
INNER JOIN nit nt ON nt.id = retOp.idNit
LEFT JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP 
LEFT JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingOp.id
LEFT JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN bodegas bod on bod.id = ingOp.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
LEFT JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
WHERE ingOp.numeroPoliza like @polizaBusca

END

DECLARE @cantPolizaRet INT
SET @cantPolizaRet = (SELECT COUNT(*) FROM retiroOperacionFiscal where polizaRetiro like @polizaBusca)

IF (@cantPolizaRet=1)
BEGIN
SELECT retOp.fechaEmision,
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-', YEAR(numRet.fechaAsignado),'-',ISNULL(numRet.numeroAsignado+@numInicio,0))) as 'numeroRetiro',

numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
convert(varchar, retOp.fechaEmision, 103) as 'emision',
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, retOp.regimenSalida, retOp.estadoRet, inv.saldoBultos
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet
INNER JOIN nit nt ON nt.id = retOp.idNit
LEFT JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP 
LEFT JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingOp.id
LEFT JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN bodegas bod on bod.id = ingOp.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
LEFT JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
WHERE retOp.polizaRetiro like @polizaBusca

END

END



GO
/****** Object:  StoredProcedure [dbo].[spRetirosHistorialRange]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRetirosHistorialRange]
@idBodega int,
@fechaInicio date,
@fechaFin date
AS
BEGIN
	SET NOCOUNT ON;


DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = 1)

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT retOp.fechaEmision,
UPPER(CONCAT(SUBSTRING(empre.establecimiento, 1, 3),'-',SUBSTRING(bod.areasAutorizadas, 1, 4),'-',bod.numeroIdentidad,'-', YEAR(numRet.fechaAsignado),'-',ISNULL(numRet.numeroAsignado+@numInicio,0))) as 'numeroRetiro',

numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
convert(varchar, retOp.fechaEmision, 103) as 'emision',
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, retOp.regimenSalida, retOp.estadoRet, inv.saldoBultos
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet
INNER JOIN nit nt ON nt.id = retOp.idNit
LEFT JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP 
LEFT JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
LEFT JOIN inventarioFiscal inv ON inv.idIngreso = ingOp.id
LEFT JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN bodegas bod on bod.id = ingOp.identBodega and bod.dependencia = @dependencia
INNER JOIN empresas empre ON empre.id = bod.dependencia
LEFT JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
LEFT JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
WHERE retOp.fechaEmision BETWEEN @fechaInicio AND @fechaFin

END



GO
/****** Object:  StoredProcedure [dbo].[spRetirosPendGeneral]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRetirosPendGeneral]
@estadoRet int,
@idBodega int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT 
numRet.numeroAsignado+@numInicio AS 'numeroRetiro',
numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, personal.nombres, personal.apellidos, retOp.regimenSalida
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND retOp.estadoRet = @estadoRet
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP 
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
INNER JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
LEFT JOIN bitacoraRetiroCalculo bitacoraRet ON bitacoraRet.transaccion LIKE 'Retiro Contabilizado' AND bitacoraRet.idOpera = retOp.id 
LEFT JOIN personal ON bitacoraRet.idUsuario = personal.id 
WHERE retOp.descripcion not like 'VEHICULOS NUEVOS'
END



GO
/****** Object:  StoredProcedure [dbo].[spRetirosPendientes]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRetirosPendientes]
@estadoRet int,
@ident int,
@idBodega int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

DECLARE @numInicio INT
SET @numInicio = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT 
numRet.numeroAsignado+@numInicio AS 'numeroRetiro',
numIng.numeroAsignado +@numInicio AS 'numeroIngreso',
convert(varchar, retOp.fechaConta, 23) as 'fecha' ,
ingOp.idNit AS 'nitIngreso',  nt.id AS 'nitRet', nt.nitEmpresa AS 'numNit', nt.nombreEmpresa AS 'empresa',  
ingOp.numeroPoliza AS 'numPolIng', retOp.polizaRetiro AS 'polRet', saldRet.peso AS 'pesoRet', 
saldRet.bultos AS 'bultosRet', srv.servicio  AS 'tipoServicio', srv.id AS 'numId', retOp.id AS 'identRet', 
ingOp.id AS 'idIngOp', retOp.estadoRet AS 'valorEstadoRet', retOp.id AS 'identificaRet',
saldRet.totalValorCif, saldRet.valorImpuesto, personal.nombres, personal.apellidos, retOp.regimenSalida
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND retOp.estadoRet = @estadoRet
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP AND ingOp.identBodega = @ident
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 
INNER JOIN numAsignadoIngresos numIng ON numIng.idIng = ingOp.id 
INNER JOIN numAsignadoRetiros numRet ON numRet.idRet = retOp.id
LEFT JOIN bitacoraRetiroCalculo bitacoraRet ON bitacoraRet.transaccion LIKE 'Retiro Contabilizado' AND bitacoraRet.idOpera = retOp.id 
LEFT JOIN personal ON bitacoraRet.idUsuario = personal.id 

END



GO
/****** Object:  StoredProcedure [dbo].[spRetPlto]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spRetPlto]


@licencia text,
@piloto text

	AS
BEGIN
	SET NOCOUNT ON;

	INSERT INTO [dbo].[pilotos]
           ([licencia]
           ,[piloto])
     VALUES
           (@licencia,
			@piloto)
SELECT @@IDENTITY AS 'IdentityPlt';


END


GO
/****** Object:  StoredProcedure [dbo].[spRetUnidades]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spRetUnidades]


@placa text,
@contenedor text

	AS
BEGIN
	SET NOCOUNT ON;


INSERT INTO [dbo].[unidades]
           ([placa]
           ,[contenedor])
     VALUES
           (
	
@placa,
@contenedor
		   )
		      SELECT @@IDENTITY AS 'IdentityUnidad';
END


GO
/****** Object:  StoredProcedure [dbo].[spRevChasis]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRevChasis]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;

SELECT chas.id, chas.chasis, tpVeh.tipoVehiculo, medida.linea FROM chasisVehiculosNuevos chas
INNER JOIN tiposDeVehiculos tpVeh ON tpVeh.id = chas.tipoVehiculo
INNER JOIN medidasVehiculos medida ON medida.id = chas.lineaVehiculo
WHERE chas.idIngreso = @valor

END
GO
/****** Object:  StoredProcedure [dbo].[spRevChasisDup]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spRevChasisDup]
	@valor text

AS
BEGIN
	SET NOCOUNT ON;


SELECT ISNULL(COUNT(*),0) AS 'cantidadChas' FROM chasisVehiculosNuevos chas
INNER JOIN ingresoOperacionFiscal ing ON ing.id = chas.idIngreso AND ing.estadoIngreso >=1 AND chas.chasis LIKE CONCAT('%',@valor,'%')

END


GO
/****** Object:  StoredProcedure [dbo].[spRevChasisSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO











CREATE PROCEDURE [dbo].[spRevChasisSalida]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
chasisV.id, chasisV.chasis, tipV.tipoVehiculo, mdv.linea, prdV.predio, prdV.descripcion  
FROM chasisVehiculosNuevos chasisV
INNER JOIN medidasVehiculos mdv ON mdv.id = chasisV.lineaVehiculo AND chasisV.id = @valor
left JOIN tiposDeVehiculos tipV ON tipV.id = chasisV.tipoVehiculo AND chasisV.estado = 1
left JOIN prediosDeVehiculos prdV ON prdV.id = chasisV.ubicacion


END


GO
/****** Object:  StoredProcedure [dbo].[spRevChasisVehN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRevChasisVehN]
@idChasis int,
@chasis text,
@linea int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranSQL
DECLARE @idTipoVeh int
SET @idTipoVeh = (SELECT idTipoVeh FROM medidasVehiculos WHERE id = @linea)

UPDATE chasisVehiculosNuevos
SET chasis = @chasis, tipoVehiculo = @idTipoVeh, lineaVehiculo = @linea
WHERE id = @idChasis

SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranSQL
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranSQL
SELECT 1 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spRevDescCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spRevDescCalc]
	@idCalculo int,
	@desPercent float,
	@tipo int,
	@valDesc float,
	@estado int,
	@idRet int
	

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranCalc 


UPDATE descuentosCalculos SET descuento = @valDesc, descuentoPercent =  @desPercent, fechaRegistro = GETDATE(), estado = @estado WHERE idCalculo = @idCalculo AND tipoOp = @tipo

IF (@idRet>=1 AND @estado=2)
BEGIN
DECLARE @idSer INT
SET @idSer = (SELECT ISNULL(id,0) FROM descuentosCalculos WHERE idCalculo = @idCalculo AND tipoOp = @tipo)

DECLARE @valida INT
SET @valida = (SELECT ISNULL(COUNT(*),0) FROM otrosServiciosDescuentos WHERE idOperacion = @idSer AND tipoOp = 0)
IF (@valida=0)
BEGIN
INSERT INTO [dbo].[otrosServiciosDescuentos]
           ([idRet]
           ,[idOperacion]
           ,[tipoOp]
           ,[fechaEmision])
     VALUES
           (@idRet
           ,@idSer
           ,0
           ,GETDATE())
END
END

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranCalc
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranCalc
SELECT 1 AS 'resp'
END
END
GO
/****** Object:  StoredProcedure [dbo].[spRevDescCalcExis]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spRevDescCalcExis]
	@idCalculo int,
	@tipo int	

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM descuentosCalculos WHERE idCalculo = @idCalculo AND tipoOp = @tipo

END


GO
/****** Object:  StoredProcedure [dbo].[spReversionChas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spReversionChas]
@idAnt int,
@idNew int
	AS
BEGIN
	SET NOCOUNT ON;

  BEGIN TRAN tranReversion
  DECLARE @error INT
  DECLARE @newRebaja INT
  SET @newRebaja = (SELECT estado FROM chasisVehiculosNuevos WHERE id = @idNew)
  DECLARE @idRet INT
  SET @idRet = (SELECT idRet FROM chasisVehiculosNuevos WHERE id = @idAnt)
  DECLARE @antRebaja INT
  SET @antRebaja = (SELECT estado FROM chasisVehiculosNuevos WHERE id = @idAnt)
  IF (@newRebaja=1)
  BEGIN
	UPDATE chasisVehiculosNuevos
	SET idRet = NULL, estado = 1
	WHERE id = @idAnt
	IF (@antRebaja = 2)
	BEGIN
	UPDATE chasisVehiculosNuevos
	SET idRet = @idRet, estado = 2
	WHERE id = @idNew
	END

SET @error= @error
	IF (@error<>0)
		BEGIN
			ROLLBACK TRAN tranReversion
			select 0 AS 'resp'
		END
		ELSE
		BEGIN
			COMMIT TRAN tranReversion
			select 1 AS 'resp'
		END
	END

END
GO
/****** Object:  StoredProcedure [dbo].[spRevertirCons]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRevertirCons]
	@valor int,
	@estado int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranSQL
DECLARE @resp INT

DECLARE @cadena varchar(32)
SET @cadena = (select cadenaVinculo from ingresosConsolidadoPoliza where idIngreso = @valor)

DECLARE @cantClientes INT
SET @cantClientes = (select count(*) from ingresosConsolidadoPoliza ingC
inner join detalleDeMercaderia det on ingC.idIngreso = det.idIngreso AND ingC.cadenaVinculo like @cadena)

DECLARE @detalles INT
SET @detalles = (SELECT COUNT(*) 
FROM ingresoOperacionFiscal ing
inner join ingresosConsolidadoPoliza ingCon ON ingCon.idIngreso = ing.id and ingCon.cadenaVinculo like @cadena and ing.estadoIngreso>=1 
inner join detalleDeMercaderia det on det.idIngreso = ing.id)

DECLARE @clientesVal INT
SET @clientesVal = (SELECT  cantidadClientes FROM valoresIngOpFiscal WHERE idIngreso = @valor)

IF (@detalles != @cantClientes AND @detalles!=@clientesVal)
BEGIN
SET @resp = 1
UPDATE ingresoOperacionFiscal
SET estadoIngreso = 1
FROM ingresoOperacionFiscal ing
INNER JOIN ingresosConsolidadoPoliza ingCon ON ingCon.idIngreso = ing.id and ingCon.cadenaVinculo like @cadena and ing.estadoIngreso>=1
END
else
begin
SET @resp = 2

end

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranSQL
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranSQL
SELECT @resp 'resp'
END

end
GO
/****** Object:  StoredProcedure [dbo].[spRevertirConsFail]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRevertirConsFail]
	@valor int,
	@estado int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranSQL
DECLARE @resp INT

DECLARE @cadena varchar(32)
SET @cadena = (select cadenaVinculo from ingresosConsolidadoPoliza where idIngreso = 842)

DECLARE @cantClientes INT
SET @cantClientes = (select count(*) from ingresosConsolidadoPoliza ingC
inner join detalleDeMercaderia det on ingC.idIngreso = det.idIngreso AND ingC.cadenaVinculo like @cadena)

DECLARE @detalles INT
SET @detalles = (SELECT COUNT(*) 
FROM ingresoOperacionFiscal ing
inner join ingresosConsolidadoPoliza ingCon ON ingCon.idIngreso = ing.id and ingCon.cadenaVinculo like @cadena and ing.estadoIngreso>=1 
inner join detalleDeMercaderia det on det.idIngreso = ing.id)

DECLARE @clientesVal INT
SET @clientesVal = (SELECT  cantidadClientes FROM valoresIngOpFiscal WHERE idIngreso = 842)

IF (@detalles = @cantClientes AND @detalles=@clientesVal)
BEGIN
SET @resp = 1
UPDATE ingresoOperacionFiscal
SET estadoIngreso = 2
FROM ingresoOperacionFiscal ing
INNER JOIN ingresosConsolidadoPoliza ingCon ON ingCon.idIngreso = ing.id and ingCon.cadenaVinculo like @cadena and ing.estadoIngreso>=1

END


SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranSQL
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranSQL
SELECT @resp 'resp'
END

end
GO
/****** Object:  StoredProcedure [dbo].[spRevertirIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRevertirIng]
@idIng int

	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @dataCadena VARCHAR(32)
SET @dataCadena = (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza ingC WHERE ingC.idIngreso = @idIng)


DECLARE @cantCadena INT
SET @cantCadena = (SELECT count(*) FROM ingresosConsolidadoPoliza ingC WHERE ingC.idIngreso = @idIng)


DECLARE @tipoVh int
set @tipoVh = (SELECT servicios.id FROM ingresoOperacionFiscal ing inner join valoresIngOpFiscal valIng ON ing.id = valIng.idIngreso and ing.id = @idIng INNER JOIN servicios ON servicios.id = ing.idServicio)

DECLARE @idVeh int
set @idVeh = (select id from servicios where servicio like  'VEHICULOS NUEVOS')

IF (@tipoVh != @idVeh)
BEGIN
DECLARE @bultosIngreso int
SET @bultosIngreso = (select isnull(sum(valIng.bultos),0) from ingresoOperacionFiscal ing inner join valoresIngOpFiscal valIng on ing.id = valIng.idIngreso and ing.id = @idIng)

DECLARE @bultosDetalle int
SET @bultosDetalle = (SELECT ISNULL(SUM(bultos),0) FROM detalleDeMercaderia WHERE idIngreso = @idIng)


IF (@bultosIngreso=@bultosDetalle)
BEGIN
SELECT 1 AS 'resp'
END

IF (@bultosIngreso!=@bultosDetalle)
BEGIN
IF (@cantCadena=0)
BEGIN
UPDATE ingresoOperacionFiscal
SET estadoIngreso = 1
WHERE id = @idIng
SELECT 0 AS 'resp'
END
IF (@cantCadena>=1)
UPDATE ingresoOperacionFiscal
SET estadoIngreso = 1
FROM 
ingresoOperacionFiscal ing
INNER JOIN ingresosConsolidadoPoliza ingC ON ingC.idIngreso = ing.id AND ingC.cadenaVinculo LIKE @dataCadena
SELECT 0 AS 'resp'
END
END
ELSE
BEGIN
SELECT 1 AS 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spRevIncid]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spRevIncid]

@llaveIdentidad int
	AS
BEGIN
	SET NOCOUNT ON;

IF (SELECT COUNT(*) FROM INCIDENCIA WHERE idIngreso=@llaveIdentidad)=0

UPDATE DETALLEMERCADERIA
SET estado = 3
WHERE id=@llaveIdentidad

ELSE
PRINT 'CONINCIDENCIA'
END


GO
/****** Object:  StoredProcedure [dbo].[spRevIncide]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spRevIncide]

@llaveIdentidad int
	AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @idBultos int
SET @idBultos = (SELECT idIngreso FROM detalleDeMercaderia WHERE id = @llaveIdentidad)
SELECT ISNULL(COUNT(*), 0) AS 'cantidad'  FROM incidencia WHERE idIngreso=@idBultos AND estadoIncidencia=1

END
GO
/****** Object:  StoredProcedure [dbo].[spRevIncideUP]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spRevIncideUP]
@empresa text,
@bultos int,
@peso float,
@llaveIdentidad int,
@tipo int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranUpdateRet
IF(@tipo=0)
BEGIN
UPDATE detalleDeMercaderia
SET empresa=@empresa,
	bultos=@bultos,
	peso=@peso
WHERE id=@llaveIdentidad
END

IF(@tipo=1)
BEGIN
UPDATE detalleDeMercaderia
SET empresa=@empresa,
	peso=@peso
WHERE id=@llaveIdentidad


END

set @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranUpdateRet
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranUpdateRet
SELECT 1 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spRevisionIngEstadoCuatro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spRevisionIngEstadoCuatro]
@idIng INT
AS
BEGIN
	SET NOCOUNT ON;



DECLARE @cons INT
SET @cons = (SELECT count(*) from ingresosConsolidadoPoliza ingC INNER JOIN ingresoOperacionFiscal ing ON ing.id = ingC.idIngreso AND idIngreso = @idIng)


DECLARE @cantIng INT
SET @cantIng = (select COUNT(*) from ingresoOperacionFiscal ing
inner join ingresosConsolidadoPoliza ingc on ingc.idIngreso = ing.id
and ingc.cadenaVinculo like (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIng))

DECLARE @ingAsig INT
SET @ingAsig = (SELECT COUNT(*) FROM numAsignadoIngresos WHERE idIng = @idIng)

IF (@cons>0)
	BEGIN
		DECLARE @cadena VARCHAR(32)
		SET @cadena = (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIng)

		DECLARE @clientesCons INT 
		SET @clientesCons = (SELECT COUNT(*) FROM ingresosConsolidadoPoliza ingC INNER JOIN ingresoOperacionFiscal ing ON ing.id = ingC.idIngreso AND ingC.cadenaVinculo LIKE @cadena)
		DECLARE @clientesDet INT
		SET @clientesDet = (SELECT COUNT(*) FROM detalleDeMercaderia det  INNER JOIN ingresosConsolidadoPoliza ingC ON ingC.idIngreso = det.idIngreso INNER JOIN ingresoOperacionFiscal ing ON ing.id = ingC.idIngreso AND ingC.cadenaVinculo LIKE @cadena)
		DECLARE @clientesValIng INT
		SET @clientesValIng = (SELECT cantidadClientes FROM valoresIngOpFiscal val INNER JOIN ingresoOperacionFiscal ing ON ing.id = val.idIngreso AND ing.id = @idIng)
		DECLARE @clientesInci INT
		SET @clientesInci = (SELECT COUNT(*) FROM incidencia inc INNER JOIN detalleDeMercaderia dt on dt.id = inc.idDetalle INNER JOIN ingresoOperacionFiscal ing on ing.id = inc.idIngreso INNER JOIN ingresosConsolidadoPoliza ingC ON ingC.idIngreso = ing.id AND ingC.cadenaVinculo like @cadena)
		DECLARE @estadoPase INT 
		SET @estadoPase = (SELECT COUNT(*) FROM ingresosConsolidadoPoliza ingC INNER JOIN ingresoOperacionFiscal ing ON ing.id = ingC.idIngreso AND ingC.cadenaVinculo LIKE @cadena and ingC.estadoOperacion>0)

		DECLARE @cantidadDePol INT
		SET @cantidadDePol = (SELECT COUNT(*) FROM ingresosConsolidadoPoliza ingC INNER JOIN ingresoOperacionFiscal ing on ing.id = ingC.idIngreso and ingC.cadenaVinculo LIKE @cadena)
	
		DECLARE @numIngCon INT
		SET @numIngCon = (SELECT COUNT(*) FROM ingresosConsolidadoPoliza ingC INNER JOIN ingresoOperacionFiscal ing on ing.id = ingC.idIngreso and ingC.cadenaVinculo LIKE @cadena INNER JOIN numAsignadoIngresos asigNum ON asigNum.idIng = ing.id)
	/* SI LA CANTIDAD DE CLIENTES DETALLADOS Y LAS INCIDENCIAS SON IGUALES, SI CUENTA CON PASE DE SALIDA, SI LOS INGRESOS ASIGNADOS SON IGUALES A LA CANTIDAD DE POLIZA Y LAS CADENAS DE INGRESO Y LA CANTIDAD DE POLIZAS SON IGUELS CONTINUA*/
	IF (@clientesValIng=@clientesInci AND  @estadoPase>0 AND @cantIng=@cantidadDePol AND @numIngCon = @cantidadDePol)
		BEGIN
			UPDATE ingresoOperacionFiscal set estadoIngreso = 4 
			FROM ingresosConsolidadoPoliza ingC 
			INNER JOIN ingresoOperacionFiscal ing ON ing.id = ingC.idIngreso AND ingC.cadenaVinculo LIKE @cadena AND ing.estadoIngreso >0
		END

END
ELSE
	BEGIN
		DECLARE @unidades INT
		SET @unidades = (SELECT count(*) FROM datosUnidades WHERE idOp = @idIng AND tipoOp = 1)

		DECLARE @salidas INT
		SET @salidas = (SELECT COUNT(*) FROM pasesDeSalida pass INNER JOIN datosUnidades datUn ON datUn.id = pass.idUnidad and datUn.idOp = @idIng and datUn.estado = 1)

		DECLARE @cantInci INT
		SET @cantInci = (SELECT COUNT(*) FROM detalleDeMercaderia det INNER JOIN incidencia inc ON inc.idDetalle = det.id AND inc.idIngreso = @idIng)

		DECLARE @detMer INT 
		SET @detMer = (SELECT  COUNT(*) FROM detalleDeMercaderia det INNER JOIN ingresoOperacionFiscal ing ON ing.id = det.idIngreso and ing.id = @idIng)


		IF (@salidas=@unidades AND @detMer = @cantInci AND @ingAsig>0)
		BEGIN
			UPDATE ingresoOperacionFiscal SET estadoIngreso = 4 WHERE id = @idIng
		END



END

END

GO
/****** Object:  StoredProcedure [dbo].[spRevisionPlto]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spRevisionPlto]
@licencia text

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @licenciaVal int
set @licenciaVal = (SELECT COUNT(*) FROM pilotos WHERE licencia LIKE @licencia)


END
GO
/****** Object:  StoredProcedure [dbo].[spRevisionRetEstadoTres]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRevisionRetEstadoTres]

	AS
BEGIN
	SET NOCOUNT ON;


SELECT 

 retOp.id AS 'idRetOperacion'

FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND (retOp.estadoRet >= 2) and (retOp.estadoRet <=3)
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega 
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 


END


GO
/****** Object:  StoredProcedure [dbo].[spRevPol]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spRevPol]
	@valor text

AS
BEGIN
	SET NOCOUNT ON;

IF (SELECT ISNULL(COUNT(*),0) AS 'resultado' FROM ingresoOperacionFiscal WHERE numeroPoliza LIKE @valor)=0
BEGIN
SELECT ISNULL(COUNT(*),0) AS 'resultado' FROM ingresoOperacionFiscal WHERE numeroPoliza LIKE @valor
END
ELSE
BEGIN
IF (SELECT ISNULL(COUNT(*),0) AS 'resultado' FROM ingresoOperacionFiscal WHERE numeroPoliza LIKE @valor)>=1
BEGIN

DECLARE @idIng int
SET @idIng = (SELECT id FROM ingresoOperacionFiscal WHERE numeroPoliza like @valor)
DECLARE @clientes int
SET @clientes = (SELECT cantidadClientes FROM valoresIngOpFiscal WHERE idIngreso = @idIng)

DECLARE @consolidado int
SET @consolidado = (select count(*) from ingresosConsolidadoPoliza where idIngreso = @idIng)

IF(@consolidado>=1)
BEGIN

IF(@clientes=@consolidado)
BEGIN
SELECT ISNULL(COUNT(*),0) AS 'resultado' FROM ingresoOperacionFiscal WHERE numeroPoliza LIKE @valor
END

ELSE

BEGIN
DECLARE @tipo int
set @tipo = -1
SELECT 
ing.id as 'identIng',
nit.nitEmpresa, servicios.id as 'servicio', regimen.id as 'regimenPol', ing.idCartaCupo,
val.cantidadContenedores, ing.dua, ing.bl, ing.numeroPoliza, val.bultos, ing.origenPuerto,
val.cantidadClientes, ing.producto, val.peso, val.valorTotalAduana, val.tipoCambio, val.totalValorCif, val.valorImpuesto, @tipo 'resultado'


FROM ingresoOperacionFiscal ing
INNER JOIN nit ON nit.id = ing.idNit
INNER JOIN servicios ON servicios.id  = ing.idServicio
INNER JOIN regimen ON regimen.id  = ing.regimen
INNER JOIN valoresIngOpFiscal val ON  val.idIngreso = ing.id
WHERE ing.id  = @idIng


END

END



ELSE
BEGIN
SELECT ISNULL(COUNT(*),0) AS 'resultado' FROM ingresoOperacionFiscal WHERE numeroPoliza LIKE @valor
END

END
END

END
GO
/****** Object:  StoredProcedure [dbo].[spRevPolizaRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spRevPolizaRet]
@numPol text
AS
BEGIN
	SET NOCOUNT ON;

SELECT ISNULL(COUNT(*),0) AS 'poliza' FROM retiroOperacionFiscal WHERE polizaRetiro LIKE @numPol

END


GO
/****** Object:  StoredProcedure [dbo].[spRevRegistroTra]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spRevRegistroTra]
	@idUsuario int,
	@idOperacion int,
	@tipoOperacion int

AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'respFinalizar' FROM registroTransacciones WHERE idUsuario=@idUsuario AND idOperacion=@idOperacion AND tipoOperacion = @tipoOperacion 

END


GO
/****** Object:  StoredProcedure [dbo].[spRevUnidadPlus]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spRevUnidadPlus]
	@idIng int,
	@newLic text,
	@newPlaca text, 
	@newContenedor text,
	@newMarchamo text,
	@tipo int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idPLT int
SET @idPLT = ISNULL((SELECT top 1 (id) FROM pilotos WHERE licencia LIKE @newLic),0)

DECLARE @resultLic int
SET  @resultLic = (SELECT ISNULL(COUNT(*), 0) FROM datosUnidades WHERE  piloto = @idPLT AND idOp = @idIng and tipoOp = @tipo)


DECLARE @resultSum int
SET @resultSum = (@resultLic)
SELECT @resultSum AS 'resultRevision'

END
GO
/****** Object:  StoredProcedure [dbo].[spRevVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO












CREATE PROCEDURE [dbo].[spRevVeh]

@idRet int,
@id int



	AS
BEGIN
	SET NOCOUNT ON;

SELECT ISNULL(COUNT(*),0) AS 'cantidadVeh' FROM chasisVehiculosNuevos
WHERE idRet = @idRet AND id = @id AND estado = 2

END


GO
/****** Object:  StoredProcedure [dbo].[spRevVehN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spRevVehN]
	@idChas int

AS
BEGIN
	SET NOCOUNT ON;


DECLARE @idIng int
SET @idIng = (SELECT idIngreso FROM chasisVehiculosNuevos WHERE id = @idChas)
                          

declare @countCh int
set @countCh = (select COUNT(estado) AS 'countChas' from chasisVehiculosNuevos where idIngreso = @idIng AND estado = 0)

SELECT @countCh AS 'countChas'

END


GO
/****** Object:  StoredProcedure [dbo].[spSaldoCobro2]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spSaldoCobro2]
	@valor int,
	@corte datetime,
	@nueva datetime

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @peso float
DECLARE @bultos int
DECLARE @aduanaDolar float
DECLARE @cif float
DECLARE @impuestos float
DECLARE @ingPeso float
DECLARE @ingBultos int
DECLARE @ingAduanaDolar float
DECLARE @ingCif float
DECLARE @ingImpuestos float
DECLARE @idIng int
	 
SET @bultos = (SELECT SUM(bultos) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),@corte,105))
SET @peso = (SELECT SUM(peso) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),@corte,105))
SET @aduanaDolar = (SELECT SUM(valorTotalAduana) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),@corte,105))
SET @cif = (SELECT SUM(totalValorCif) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),@corte,105))
SET @impuestos = (SELECT SUM(valorImpuesto) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valor AND convert(varchar(12),sdlRet.fechaRetiro,105) = convert(varchar(12),@corte,105))

SET @idIng = (SELECT TOP(1) sldf.idIngreso FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = @valor ORDER BY sldf.id)
SET @ingPeso = (SELECT SUM(sldf.peso)-@peso AS 'saldoPeso' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = @valor)
SET @ingBultos = (SELECT SUM(sldf.bultos)-@bultos AS 'saldosBultos' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = @valor)
SET @ingAduanaDolar = (SELECT SUM(sldf.valorTotalAduana)-@aduanaDolar AS 'saldoAduana' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = @valor)
SET @ingCif = (SELECT SUM(sldf.totalValorCif)-@cif AS 'saldoCif' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = @valor)
SET @ingImpuestos = (SELECT SUM(sldf.valorImpuesto)-@impuestos AS 'saldoImpuesto' FROM SALDOS_FISCAL sldf INNER JOIN SALDOS_FISCAL sldfr ON sldf.idIngreso = sldfr.idIngreso AND sldf.idIngreso = @valor)

DECLARE @idSaldoCobro int
SET @idSaldoCobro = (SELECT TOP (1) sldC.id FROM SALDOS_COBROS sldC WHERE sldC.idIngreso = 1 AND sldC.estadoSaldo = 1 ORDER BY sldC.estadoSaldo DESC)  


UPDATE SALDOS_COBROS
SET peso = @ingPeso, bultos = @ingBultos, valorTotalAduana = @ingAduanaDolar, tipoCambio = 0, totalValorCif = @ingCif, valorImpuesto = @ingImpuestos
WHERE id = @idSaldoCobro
END


GO
/****** Object:  StoredProcedure [dbo].[spSaldos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spSaldos]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;
SELECT ingOp.id AS 'identificador', nt.nitEmpresa AS 'nit', nt.nombreEmpresa AS 'empresa', ingOp.numeroPoliza AS 'poliza'
, ingOp.fechaRegistro AS 'fechaRegistro', invent.saldoBultos AS 'blts'
, invent.saldoValorCif AS 'cif', invent.saldoValorImpuesto AS 'impuesto', ingOp.estadoIngreso AS 'accionEstado'  
  FROM inventarioFiscal invent
INNER JOIN ingresoOperacionFiscal ingOp ON invent.idIngreso = ingOp.id AND ingOp.identBodega = @valor AND ingOp.estadoIngreso >= 4
INNER JOIN nit nt  ON nt.id = ingOp.idNit
END
GO
/****** Object:  StoredProcedure [dbo].[spSaldosCif]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spSaldosCif]
	@idEmpresa int

AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @depe INT
	SET @depe = (SELECT dependencia FROM bodegas WHERE id = @idEmpresa)
SELECT cta0102.operacion, convert(varchar, correlPoliza.fecha, 23) as 'fecha', debeHaber.concepto, ROUND(cta0102.monto, 2) AS 'monto', ROUND(cta0102.saldo, 2) AS 'saldo', cta0102.tipoTransaccion  FROM saldoContable802103_0102 cta0102
LEFT JOIN polizasContaFiscal polConta ON cta0102.idPoliza = polConta.id
LEFT JOIN correaltivoPoliza correlPoliza ON correlPoliza.numero = cta0102.numeroPoliza
LEFT JOIN debeHaber ON debeHaber.id = polConta.idDebeHaber
WHERE cta0102.idEmpresa = @depe
END


GO
/****** Object:  StoredProcedure [dbo].[spSaldosCobro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spSaldosCobro]
@corte datetime,
@valorId int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @sldCobro int
DECLARE @sldoRetiro int
DECLARE @nullBultos float
SET @sldCobro = (SELECT COUNT(*) FROM SALDOS_FISCAL sldC WHERE sldC.idIngreso = @valorId)
SET @sldoRetiro = (SELECT COUNT(*) FROM SALDOS_FISCALRET sdlRet WHERE sdlRet.idIngreso = @valorId AND convert(varchar(10),sdlRet.fechaRetiro,23) = convert(varchar(10),@corte,23))

IF @sldCobro=1 AND @sldoRetiro=1
SELECT 1 AS 'respuestaSele' 
ELSE
IF @sldCobro=1 AND @sldoRetiro>=2
SELECT 2 AS 'respuestaSele'

END
GO
/****** Object:  StoredProcedure [dbo].[spSaldosContabilizados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spSaldosContabilizados]

@valor int,
@estado int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT ingOp.id AS 'identificador', nt.nitEmpresa AS 'nit', nt.nombreEmpresa AS 'empresa', ingOp.numeroPoliza AS 'poliza'
, ingOp.fechaRegistro AS 'fechaRegistro', val.bultos AS 'blts'
, val.totalValorCif AS 'cif', val.valorImpuesto AS 'impuesto', ingOp.estadoIngreso AS 'accionEstado'  
  FROM valoresIngOpFiscal val
INNER JOIN ingresoOperacionFiscal ingOp ON val.idIngreso = ingOp.id 
AND ingOp.identBodega = @valor AND ingOp.estadoIngreso = @estado
INNER JOIN nit nt  ON nt.id = ingOp.idNit 


END


GO
/****** Object:  StoredProcedure [dbo].[spSaldosContables]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spSaldosContables]
@ident int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @countImpts INT
SET @countImpts = (SELECT COUNT(*) AS 'countImpts' FROM saldoContable801109_01 WHERE idEmpresa = @ident)

DECLARE @countCif INT
SET @countCif = (SELECT COUNT(*) AS 'countCif' FROM saldoContable802103_0102 WHERE idEmpresa = @ident)

SELECT @countImpts AS 'countImpts', @countCif AS 'countCif'

END
GO
/****** Object:  StoredProcedure [dbo].[spSaldosContablesAF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spSaldosContablesAF]
@ident int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @countImpts INT
SET @countImpts = (SELECT COUNT(*) AS 'countImpts' FROM saldoContable801109_01AF WHERE idEmpresa = @ident)

DECLARE @countCif INT
SET @countCif = (SELECT COUNT(*) AS 'countCif' FROM saldoContable802103_0101AF WHERE idEmpresa = @ident)

SELECT @countImpts AS 'countImpts', @countCif AS 'countCif'

END
GO
/****** Object:  StoredProcedure [dbo].[spsaldosContablesF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spsaldosContablesF]
	@idEmpresa int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idSaldoCif INT
SET @idSaldoCif = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable802103_0102 WHERE idEmpresa = @idEmpresa)

DECLARE @idSaldoCifImpts INT
SET @idSaldoCifImpts = (SELECT ISNULL(MAX(id) ,0) FROM saldoContable801109_01 WHERE idEmpresa = @idEmpresa)

DECLARE @cifMostrado FLOAT
SET @cifMostrado = (SELECT saldo AS 'saldoCif' FROM saldoContable802103_0102 WHERE id = @idSaldoCif)

DECLARE @imptsMostrado FLOAT
SET @imptsMostrado = (SELECT saldo AS 'saldoImpuestos' FROM saldoContable801109_01 WHERE id = @idSaldoCifImpts)

SELECT @cifMostrado AS 'saldoCif', @imptsMostrado AS 'saldoImpuestos'

END


GO
/****** Object:  StoredProcedure [dbo].[spSaldosContaGeneral]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spSaldosContaGeneral]

@idBodega int,
@estado int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

SELECT ingOp.id AS 'identificador', nt.nitEmpresa AS 'nit', nt.nombreEmpresa AS 'empresa', ingOp.numeroPoliza AS 'poliza'
, ingOp.fechaRegistro AS 'fechaRegistro', valIng.bultos AS 'blts'
, valIng.totalValorCif AS 'cif', valIng.valorImpuesto AS 'impuesto', ingOp.estadoIngreso AS 'accionEstado', bodegas.numeroIdentidad
  FROM ingresoOperacionFiscal ingOp
INNER JOIN inventarioFiscal invent ON invent.idIngreso = ingOp.id AND ingOp.estadoIngreso = @estado
INNER JOIN valoresIngOpFiscal valIng ON valIng.idIngreso = ingOp.id
INNER JOIN bodegas on bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
INNER JOIN nit nt  ON nt.id = ingOp.idNit 
ORDER BY valIng.fechaRealIng ASC


END


GO
/****** Object:  StoredProcedure [dbo].[spSaldosDR]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spSaldosDR]
@poliza text,
@bultos int,
@cif float,
@impuesto float


	AS
BEGIN
	SET NOCOUNT ON;



DECLARE @idIngreso  INT
SET @idIngreso = (SELECT ing.id FROM ingresoOperacionFiscal ing where numeroPoliza like @poliza)


/*
*	SALDO DE BULTOS INGRESO MENOS RETIRO
*/

DECLARE @bultosIng INT
SET @bultosIng = (select ISNULL(SUM(valIng.bultos),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @bultosRet INT
SET @bultosRet = (select ISNULL(SUM(valRet.bultos),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso AND valRet.estadoSaldo = 1)

DECLARE @bultosRetDR INT
SET @bultosRetDR = (select ISNULL(SUM(valRetDR.bultos),0) from valoresPolizaDR valRetDR WHERE valRetDR.idIng = @idIngreso)


DECLARE @saldoBultos INT
SET @saldoBultos = (@bultosIng-(@bultosRet+@bultosRetDR+@bultos))



/*
*	SALDO DE BULTOS INGRESO VALDOLARES MENOS RETIRO VALDORES
*/
DECLARE @cifIng FLOAT
SET @cifIng = (select ISNULL(SUM(valIng.totalValorCif),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @cifRet FLOAT
SET @cifRet = (select ISNULL(SUM(valRet.totalValorCif),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso AND valRet.estadoSaldo = 1)

DECLARE @cifRetDR FLOAT
SET @cifRetDR = (select ISNULL(SUM(valRetDR.cif),0) from valoresPolizaDR valRetDR WHERE valRetDR.idIng = @idIngreso)


DECLARE @saldocif FLOAT
SET @saldocif = (@cifIng-(@cifRet+@cifRetDR+@cif))


/*
*	SALDO DE BULTOS INGRESO VALDOLARES MENOS RETIRO VALDORES
*/
DECLARE @impuestoIng FLOAT
SET @impuestoIng = (select ISNULL(SUM(valIng.valorImpuesto),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @impuestoRet FLOAT
SET @impuestoRet = (select ISNULL(SUM(valRet.valorImpuesto),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso AND valRet.estadoSaldo = 1)

DECLARE @impuestoRetDR FLOAT
SET @impuestoRetDR = (select ISNULL(SUM(valRetDR.impuesto),0) from valoresPolizaDR valRetDR WHERE valRetDR.idIng = @idIngreso)

DECLARE @saldoimpuesto FLOAT
SET @saldoimpuesto = (@impuestoIng-(@impuestoRet+@impuestoRetDR+@impuesto))

DECLARE @inv int
SET @inv = (SELECT COUNT(*) FROM inventarioFiscal where tipo like 'AF' and idIngreso = @idIngreso OR tipo like 'ALMACENFISCAL' and idIngreso = @idIngreso OR tipo like 'ALMFISCAL' and idIngreso = @idIngreso)

SELECT @saldoBultos AS 'bultos', ROUND(@saldocif, 2) AS 'cif', ROUND(@saldoimpuesto,2) AS 'saldoImpts', @inv AS 'tipo', @idIngreso AS 'idIngDR'


END

      
GO
/****** Object:  StoredProcedure [dbo].[spSaldosImpts]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spSaldosImpts]
	@idEmpresa int

AS
BEGIN
	SET NOCOUNT ON;
		DECLARE @depe INT
		SET @depe = (SELECT dependencia FROM bodegas WHERE id = @idEmpresa)
SELECT cta01.operacion, convert(varchar, correlPoliza.fecha, 23) as 'fecha', debeHaber.concepto, ROUND(cta01.monto, 2) AS 'monto', ROUND(cta01.saldo, 2) AS 'saldo', cta01.tipoTransaccion  FROM saldoContable801109_01 cta01
LEFT JOIN polizasContaFiscal polConta ON cta01.idPoliza = polConta.id
LEFT JOIN correaltivoPoliza correlPoliza ON correlPoliza.numero = cta01.numeroPoliza
LEFT JOIN debeHaber ON debeHaber.id = polConta.idDebeHaber
WHERE cta01.idEmpresa = @depe

END


GO
/****** Object:  StoredProcedure [dbo].[spSaldosInventario]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spSaldosInventario]
	@idBodega INT
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

SELECT ing.id FROM ingresoOperacionFiscal ing
INNER JOIN inventarioFiscal inv ON inv.idIngreso = ing.id
INNER JOIN bodegas bod on bod.id = ing.identBodega and bod.dependencia = @dependencia
AND ing.estadoIngreso >=4 AND inv.saldoBultos >0

END


GO
/****** Object:  StoredProcedure [dbo].[spSaldosRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spSaldosRet]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;



SELECT retOp.id, retOp.polizaRetiro, retOp.regimenSalida,
sldRet.bultos, sldRet.totalValorCif, sldRet.valorImpuesto, convert(varchar(12),retOp.fechaEmision,105) AS 'fechaRetiro'
FROM retiroOperacionFiscal retOp 
INNER JOIN valoresIngOpFiscal sldf ON sldf.idIngreso = @valor
INNER JOIN valoresRetirosFiscal sldRet ON sldRet.idRet = retOp.id AND sldRet.idIngreso = sldf.idIngreso
  


END
GO
/****** Object:  StoredProcedure [dbo].[spSaldosSuper]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spSaldosSuper]
@idBodega INT


	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas where id = @idBodega)

SELECT ingOp.id AS 'identificador', nt.nitEmpresa AS 'nit', nt.nombreEmpresa AS 'empresa', ingOp.numeroPoliza AS 'poliza'
, ingOp.fechaRegistro AS 'fechaRegistro', invent.saldoBultos AS 'blts'
, invent.saldoValorCif AS 'cif', invent.saldoValorImpuesto AS 'impuesto', ingOp.estadoIngreso AS 'accionEstado'  
  FROM inventarioFiscal invent
INNER JOIN ingresoOperacionFiscal ingOp ON invent.idIngreso = ingOp.id  AND ingOp.estadoIngreso >= 4
INNER JOIN bodegas bod on bod.id = ingOp.identBodega and bod.dependencia = @dependencia
INNER JOIN nit nt  ON nt.id = ingOp.idNit 
order by ingOp.fechaRegistro asc

END
GO
/****** Object:  StoredProcedure [dbo].[spSEjecutivo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spSEjecutivo]

		@valor int

AS
BEGIN
	SET NOCOUNT ON;


SELECT * FROM PERSONAL WHERE id = @valor



END


GO
/****** Object:  StoredProcedure [dbo].[spSelecDetalle]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spSelecDetalle]
	@idDetalle int

AS
BEGIN
	SET NOCOUNT ON;

SELECT id AS 'identificadorDet', empresa, bultos, peso FROM detalleDeMercaderia WHERE id=@idDetalle AND estado = 1

END


GO
/****** Object:  StoredProcedure [dbo].[spSelectDetRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spSelectDetRet]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


SELECT det.id AS 'identificadorDet', det.idIngreso AS 'identificadorIng', nt.nombreEmpresa AS 'nombreConsolidado',
 det.empresa, inci.descripcionMercaderia, det.stock as 'bultos', det.peso, ing.numeroPoliza
FROM ingresoOperacionFiscal ing
INNER JOIN detalleDeMercaderia det ON ing.id = det.idIngreso AND ing.id=@valor AND det.estado = 1 AND det.stock >= 1
INNER JOIN incidencia inci ON inci.idDetalle = det.id
INNER JOIN nit nt ON nt.id = ing.idNit 


END


GO
/****** Object:  StoredProcedure [dbo].[spSelectPersonal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spSelectPersonal]
	@valor text,
	@idDepend int
AS
BEGIN
	SET NOCOUNT ON;
select persona.id AS 'indentyPersona', persona.nombres, persona.apellidos FROM 
departamentos depart
INNER JOIN PERSONAL persona ON persona.departamento = depart.id AND depart.departamentos LIKE CONCAT('%',@valor,'%') AND persona.estado = 1


END
GO
/****** Object:  StoredProcedure [dbo].[spSelectStockBultos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spSelectStockBultos]
	@idDetalle int

AS
BEGIN
	SET NOCOUNT ON;

SELECT empresa AS 'nombreEmpresa', stock AS 'bultosDetalle' FROM detalleDeMercaderia where id = @idDetalle

END


GO
/****** Object:  StoredProcedure [dbo].[spSerTarifa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spSerTarifa]
@value int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT srv.id AS 'identy', srv.servicio AS 'servicio' FROM USUARIOSEXTERNOS usx
INNER JOIN ALMACENAJES alm ON usx.id = alm.idUsuarioCliente AND usx.idNit = @value	
INNER JOIN SERVICIOS srv ON srv.id = alm.idServicio AND srv.tipoAlmacenaje LIKE 'af'

END


GO
/****** Object:  StoredProcedure [dbo].[spServExtraCorrel]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spServExtraCorrel]



	AS
BEGIN
	SET NOCOUNT ON;
SELECT nit.nitEmpresa, nit.nombreEmpresa, ret.polizaRetiro, otrServ.otrosServicios, servCob.montoServicio from serviciosExtrasPrestados servCob 
INNER JOIN otrosServicios otrServ ON servCob.idServicio = otrServ.id
INNER JOIN retiroOperacionFiscal ret ON ret.id = servCob.idCalculo
INNER JOIN nit on nit.id = ret.idNit 
END
GO
/****** Object:  StoredProcedure [dbo].[spServicio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spServicio]
	@idServicio int
AS
BEGIN
	SET NOCOUNT ON;

select servicio from servicios
where id = @idServicio


END


GO
/****** Object:  StoredProcedure [dbo].[spServicioDefault]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spServicioDefault]
	
	AS
BEGIN
	SET NOCOUNT ON;

SELECT id AS 'servicio', servicioDefault AS 'servicioDef' FROM serviciosDefault


END
GO
/****** Object:  StoredProcedure [dbo].[spServicioF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spServicioF]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT id AS 'idServicio', servicio AS 'nombreServicio' FROM SERVICIOS WHERE tipoAlmacenaje LIKE 'af' OR tipoAlmacenaje LIKE 'ac'


END
GO
/****** Object:  StoredProcedure [dbo].[spSldInicialConta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spSldInicialConta]
@idBodega int,
@cifSaldo float,
@impuesto float

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranSaldoInicio

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)

INSERT INTO [dbo].[saldoContable802103_0102]
([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@dependencia, '0', '0', 'SALDO INICIAL', 'INICIAL', 0, @cifSaldo)


INSERT INTO [dbo].[saldoContable801109_01]
([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@dependencia, '0', '0', 'SALDO INICIAL', 'INICIAL', 0, @impuesto)

SET @error = @@ERROR

IF (@error<>0)
BEGIN
ROLLBACK TRAN tranSaldoInicio
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranSaldoInicio
SELECT 1 'resp'

END
END
GO
/****** Object:  StoredProcedure [dbo].[spSldInicialContaAF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spSldInicialContaAF]
@idBodega int,
@cifSaldo float,
@impuesto float

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranSaldoInicio

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @idBodega)

INSERT INTO [dbo].[saldoContable802103_0101AF]
([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@dependencia, '0', '0', 'SALDO INICIAL', 'INICIAL', 0, @cifSaldo)


INSERT INTO [dbo].[saldoContable801109_01AF]
([idEmpresa], [idPoliza], [numeroPoliza], [tipoTransaccion], [operacion], [monto], [saldo])
VALUES (@dependencia, '0', '0', 'SALDO INICIAL', 'INICIAL', 0, @impuesto)

SET @error = @@ERROR

IF (@error<>0)
BEGIN
ROLLBACK TRAN tranSaldoInicio
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranSaldoInicio
SELECT 1 'resp'

END
END
GO
/****** Object:  StoredProcedure [dbo].[spSldosFcal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spSldosFcal]
@idIngreso int,
@cantidadContenedores int,
@cantidadClientes int,
@peso float,
@bultos int,
@valorTotalAduana float,
@tipoCambio float,
@totalValorCif float,
@valorImpuesto float,
@estadoSaldo int,
@fechaRealIng datetime
	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[valoresIngOpFiscal]
           ([idIngreso]
           ,[cantidadContenedores]
           ,[cantidadClientes]
           ,[peso]
           ,[bultos]
           ,[valorTotalAduana]
           ,[tipoCambio]
           ,[totalValorCif]
           ,[valorImpuesto]
           ,[estadoSaldo]
           ,[fechaRealIng])
     VALUES
           (
@idIngreso,
@cantidadContenedores,
@cantidadClientes,
@peso,
@bultos,
@valorTotalAduana,
@tipoCambio,
@totalValorCif,
@valorImpuesto,
@estadoSaldo,
@fechaRealIng
		   )

END


GO
/****** Object:  StoredProcedure [dbo].[spspRevPolizaRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spspRevPolizaRet]
@numPol text
AS
BEGIN
	SET NOCOUNT ON;

SELECT ISNULL(COUNT(*),0) AS 'poliza' FROM retiroOperacionFiscal WHERE polizaRetiro LIKE @numPol
AND estadoRet = 1
END


GO
/****** Object:  StoredProcedure [dbo].[spStockDetalles]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spStockDetalles]
@idIngreso int
	AS
BEGIN
	SET NOCOUNT ON;

	EXECUTE spStockGeneral @idIngreso
SELECT detM.id AS 'idDetalle', detM.empresa AS 'Empresa', inci.descripcionMercaderia AS 'DescripciÃ³n', 
detM.bultos as 'bltsIng', inci.posiciones AS 'posIng', inci.metros AS 'mtsIng', 
detM.stock AS 'stock_Bultos', inci.stockPos AS 'stock_Posiciones',
inci.stockMts AS 'stock_Metros', detM.peso AS 'stock_Peso' FROM detalleDeMercaderia detM 

INNER JOIN incidencia inci ON detM.id = inci.idDetalle where detM.idIngreso = @idIngreso

END
GO
/****** Object:  StoredProcedure [dbo].[spStockGeneral]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spStockGeneral]
@idIngreso int

	AS
BEGIN
	SET NOCOUNT ON;


DECLARE @error int
BEGIN TRAN tranStock

/*
*	SALDO DE BULTOS INGRESO MENOS RETIRO
*/

DECLARE @bultosIng INT
SET @bultosIng = (select ISNULL(SUM(valIng.bultos),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @bultosRet INT
SET @bultosRet = (select ISNULL(SUM(valRet.bultos),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso AND valRet.estadoSaldo = 1)

DECLARE @bultosRetDR INT
SET @bultosRetDR = (select ISNULL(SUM(valRetDR.bultos),0) from valoresPolizaDR valRetDR WHERE valRetDR.idIng = @idIngreso)


DECLARE @saldoBultos INT
SET @saldoBultos = (@bultosIng-(@bultosRet+@bultosRetDR))



/*
*	SALDO DE BULTOS INGRESO VALDOLARES MENOS RETIRO VALDORES
*/
DECLARE @AduanaIng FLOAT
SET @AduanaIng = (select ISNULL(SUM(valIng.valorTotalAduana),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @AduanaRet FLOAT
SET @AduanaRet = (select ISNULL(SUM(valRet.valorTotalAduana),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso AND valRet.estadoSaldo = 1)

DECLARE @AduanaRetDR FLOAT
SET @AduanaRetDR = (select ISNULL(SUM(valRetDR.valDolares),0) from valoresPolizaDR valRetDR WHERE valRetDR.idIng = @idIngreso)


DECLARE @saldoAduana FLOAT
SET @saldoAduana = (@AduanaIng-(@AduanaRet+@AduanaRetDR))


/*
*	SALDO DE BULTOS INGRESO VALDOLARES MENOS RETIRO VALDORES
*/
DECLARE @cifIng FLOAT
SET @cifIng = (select ISNULL(SUM(valIng.totalValorCif),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @cifRet FLOAT
SET @cifRet = (select ISNULL(SUM(valRet.totalValorCif),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso AND valRet.estadoSaldo = 1)

DECLARE @cifRetDR FLOAT
SET @cifRetDR = (select ISNULL(SUM(valRetDR.cif),0) from valoresPolizaDR valRetDR WHERE valRetDR.idIng = @idIngreso)


DECLARE @saldocif FLOAT
SET @saldocif = (@cifIng-(@cifRet+@cifRetDR))


/*
*	SALDO DE BULTOS INGRESO VALDOLARES MENOS RETIRO VALDORES
*/
DECLARE @impuestoIng FLOAT
SET @impuestoIng = (select ISNULL(SUM(valIng.valorImpuesto),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @impuestoRet FLOAT
SET @impuestoRet = (select ISNULL(SUM(valRet.valorImpuesto),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso AND valRet.estadoSaldo = 1)

DECLARE @impuestoRetDR FLOAT
SET @impuestoRetDR = (select ISNULL(SUM(valRetDR.impuesto),0) from valoresPolizaDR valRetDR WHERE valRetDR.idIng = @idIngreso)

DECLARE @saldoimpuesto FLOAT
SET @saldoimpuesto = (@impuestoIng-(@impuestoRet+@impuestoRetDR))



/*
*	SALDO DE BULTOS INGRESO VALDOLARES MENOS RETIRO VALDORES
*/
DECLARE @pesoIng FLOAT
SET @pesoIng  = (select ISNULL(SUM(valIng.peso),0) from valoresIngOpFiscal valIng WHERE valIng.idIngreso = @idIngreso)

DECLARE @pesoRet FLOAT
SET @pesoRet = (select ISNULL(SUM(valRet.peso),0) from valoresRetirosFiscal valRet WHERE valRet.idIngreso = @idIngreso)

DECLARE @saldopeso FLOAT
SET @saldopeso = (@pesoIng-@pesoRet)

UPDATE inventarioFiscal
SET
saldoBultos = @saldoBultos,
saldoValorTAduana = ROUND(@saldoAduana, 2),
saldoValorCif = ROUND(@saldocif,2),
saldoValorImpuesto = ROUND(@saldoimpuesto,2),
pesoKg = ROUND(@saldopeso,2)
WHERE idIngreso = @idIngreso

SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranStock
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranStock
SELECT 1 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spStockIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spStockIng]
@idDetalle int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT detM.stock AS 'stockBultos', inci.stockPos AS 'stockPosocicion', inci.stockMts AS 'stockMetros' FROM detalleDeMercaderia detM
INNER JOIN incidencia inci ON detM.id = inci.idDetalle AND detM.id = @idDetalle
END


GO
/****** Object:  StoredProcedure [dbo].[spStockPosMts]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spStockPosMts]

@idDetalle int,
@pos int,
@mts float

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @stockPos INT
SET @stockPos = (SELECT stockPos FROM incidencia WHERE idDetalle = @idDetalle)+@pos
select @stockPos


DECLARE @stockMts INT
SET @stockMts = (SELECT stockMts FROM incidencia WHERE idDetalle = @idDetalle)+@mts
select @stockMts

UPDATE incidencia
SET stockPos = @stockPos, stockMts = @stockMts
WHERE idDetalle = @idDetalle


END


GO
/****** Object:  StoredProcedure [dbo].[spSubBitacoraCal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spSubBitacoraCal]
@idBitacora int,
@timefechaCalc datetime
	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[subBitacoraCalc]
           ([idBitacora]
           ,[fechaCalc])
     VALUES
           (@idBitacora
           ,@timefechaCalc)

END


GO
/****** Object:  StoredProcedure [dbo].[spSumBlsDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spSumBlsDet]
	@id1 int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @cantBultos int
SET @cantBultos = (SELECT bultos FROM detalleDeMercaderia WHERE id=@id1)

DECLARE @idIngreso int
SET @idIngreso = (SELECT idIngreso FROM detalleDeMercaderia WHERE id=@id1)


SELECT SUM(bultos)-@cantBultos AS 'bultosDetalle' FROM detalleDeMercaderia WHERE idIngreso=@idIngreso AND estado<>3

END


GO
/****** Object:  StoredProcedure [dbo].[spSumBlsDeta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spSumBlsDeta]

	@id2 int

AS
BEGIN
	SET NOCOUNT ON;

SELECT ISNULL(SUM(bultos),0) AS 'bultosDetalle' FROM detalleDeMercaderia WHERE idIngreso=@id2 AND estado<>3

END
	
GO
/****** Object:  StoredProcedure [dbo].[spSumBlts]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spSumBlts]
	@idSuma int
AS
BEGIN
	SET NOCOUNT ON;
   

 
 SELECT SUM(bultos) AS 'BULTOS' FROM DETALLESMERCADERIAS WHERE idIngreso=@idSuma
	



END


GO
/****** Object:  StoredProcedure [dbo].[spSumDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spSumDet]
	@valor int
AS
BEGIN
	SET NOCOUNT ON;

SELECT SUM(dtMer.bultos) AS 'bultos', SUM(inci.posiciones) AS 'pos', SUM(inci.metros) AS 'mts'
 FROM ingresoOperacionFiscal ingOp
INNER JOIN detalleDeMercaderia dtMer ON ingOp.id = dtMer.idIngreso AND ingOp.id=@valor
INNER JOIN incidencia inci ON ingOp.id = inci.idIngreso

END


GO
/****** Object:  StoredProcedure [dbo].[spSumRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spSumRet]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT SUM(bultos) AS 'cantBultos', 0 AS 'cantPos', 0 AS 'Cantmts' FROM SALDOS_FISCALRET WHERE idIngreso = 1

END


GO
/****** Object:  StoredProcedure [dbo].[spSumTotalPol]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spSumTotalPol]
@numPol int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT sum(monto) AS 'sumaMonto' FROM polizasContaFiscal WHERE numeroPoliza = @numPol and idDebeHaber = 1 


END
GO
/****** Object:  StoredProcedure [dbo].[spSuperEstadoRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spSuperEstadoRet]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @recAsgi INT
SET @recAsgi = (SELECT ISNULL(COUNT(recAs.idRet),0)
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND (retOp.estadoRet >= 2) and (retOp.estadoRet <=3)
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega 
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 
LEFT JOIN numAsignadoRecibos recAs ON recAs.idRet = retOp.id
LEFT JOIN numAsignadoRetiros retAs ON retAs.idRet = retOp.id
where retOp.id = @valor)



DECLARE @retAsgi INT
SET @retAsgi = (SELECT ISNULL(COUNT(retAs.idRet),0)
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND (retOp.estadoRet >= 2) and (retOp.estadoRet <=3)
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega 
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 
LEFT JOIN numAsignadoRecibos recAs ON recAs.idRet = retOp.id
LEFT JOIN numAsignadoRetiros retAs ON retAs.idRet = retOp.id
where retOp.id = @valor)

DECLARE @unidades INT 
SET @unidades = (SELECT ISNULL(COUNT(*),0) FROM datosUnidades WHERE idOp = @valor and estado >= 1 and tipoOp = 2)

IF (SUM(@retAsgi+@recAsgi)=2 AND @unidades>=1)
BEGIN
UPDATE retiroOperacionFiscal SET estadoRet = 4 WHERE id = @valor
END
ELSE
BEGIN 
SELECT 0 
END


END


GO
/****** Object:  StoredProcedure [dbo].[spTarifaCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spTarifaCalc]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;
SELECT alm.idTarifa AS 'identy',alm.baseCalculo AS 'base', alm.calculoSobre AS 'calculoSobre', alm.periodoCalculo AS 'periodoCalculo',
 alm.Moneda AS 'moneda', alm.valorTarifa AS 'valTarifa' FROM almacenajes alm
INNER JOIN ingresoOperacionFiscal ing ON ing.idServicio = alm.idServicio AND ing.id = @valor
END
GO
/****** Object:  StoredProcedure [dbo].[spTarifaCalN]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spTarifaCalN]
@idIng int,
@idRet int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @servicio varchar(50)
SET @servicio = (select rg.familia from ingresoOperacionFiscal ing INNER JOIN regimen rg ON ing.id = @idIng AND ing.regimen = rg.id)

select  trN.baseAlmacenaje AS 'baseAlm', trN.PeriodoAlmacenaje, trN.tarifaAlmacenaje, trN.baseZonaAduanera  AS 'baseZA', trN.PeriodoZonaAduanera,
trN.tarifaZonaAduanera, trN.baseManejo, trN.tarifaManejo,
trN.baseGastosAdmin, trN.tarifaGastosAdministrativos  AS 'TarifaGtsAdmin', trN.baseGastosFotocopias AS 'baseCopias', trN.tarifaFotocopias, trN.baseCalculoDescargaRevision AS 'baseRevision',
trN.calculoDescargaRevision  AS 'calculoDescarga', trN.baseCalculoOtrosGastos AS 'baseOtrosGsts', trN.calculoOtrosGastos  AS 'calcOtrosGsts', 
convert(varchar(12),trN.fechaVencimiento,105) AS 'fechaVenc', convert(varchar(12),sldIng.fechaRealIng,105) AS 'fechaRealIng', trN.delAlmacenaje AS 'delAlm'
, trN.alAlmacenaje AS 'alAlm', trN.delZA AS 'delZA', trN.minGastosAdministracion, trN.minimoAlmacenaje, trN.minimoZonaAduanera, trN.minimoManejo, sldIng.cantidadClientes, @servicio AS 'familiaPoliza',

calcN.valorImpuesto AS 'calculoValorImpuesto', calcN.valorCif AS 'calculoValorCif', calcN.pesoKG as 'calculoPesoKg',  convert(varchar(12),calcN.fechaParaCalculo,105) AS 'hiddenDateTime', nt.nombreEmpresa, calcN.poliza AS 'numeroPoliza', 
calcN.regimen, nt.nitEmpresa
 FROM 
ingresoOperacionFiscal ingIng
INNER JOIN valoresIngOpFiscal sldIng ON ingIng.id = sldIng.idIngreso
INNER JOIN tarifasNormales trN ON trN.Regimen_Nit LIKE @servicio
INNER JOIN calculosNormal calcN ON calcN.id = @idRet
INNER JOIN nit nt ON nt.id = calcN.idNitSalida

END


GO
/****** Object:  StoredProcedure [dbo].[spTarifaVehUsados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spTarifaVehUsados]
	@idIng int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idNit INT
SET @idNit = (select idNit from ingresoOperacionFiscal where id = @idIng)

DECLARE @clientes int
set @clientes = (select cantidadClientes from valoresIngOpFiscal where idIngreso = @idIng)

SELECT [id]
      ,[idNit]
      ,[servicio]
      ,[tipoMinimo]
      ,[minimoCobro]
      ,[diaDeta]
      ,[deltaAlmacenajeDiario]
      ,[ultimaTarifa]
      ,[marchamoElectronico]
      ,[aplicaMarchamoElec]
      ,[minimoMarch]
      ,convert(varchar(12),apartirFecha,105) AS 'apartirFecha', @clientes AS 'clientes' FROM tarifasVehUsados
	  
	  WHERE idNit = @idNit

END


GO
/****** Object:  StoredProcedure [dbo].[spTElectronica]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spTElectronica]
@idRegistroCobro int,
@idIngreso int,
@transElec float

	AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[cobrosGastosAdminFiscal]
           ([idRegistroCobro]
           ,[idIngreso]
           ,[rubrosGtoAdmin])
     VALUES
           (@idRegistroCobro
           ,@idIngreso
           ,@transElec)

END
GO
/****** Object:  StoredProcedure [dbo].[spTipoServicio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spTipoServicio]
	@idIng int
AS
BEGIN
	SET NOCOUNT ON;

SELECT almacenajes.baseCalculo as 'base', ing.idNit AS 'nit' FROM almacenajes 
INNER JOIN servicios ON servicios.id =  almacenajes.idServicio
INNER JOIN ingresoOperacionFiscal ing ON servicios.id = ing.idServicio
WHERE ing.id = @idIng

END


GO
/****** Object:  StoredProcedure [dbo].[spTipoVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spTipoVeh]


AS
BEGIN
	SET NOCOUNT ON;

SELECT med.id, tip.tipoVehiculo, med.linea FROM medidasVehiculos med
INNER JOIN tiposDeVehiculos tip ON tip.id = med.idTipoVeh
END


GO
/****** Object:  StoredProcedure [dbo].[spTotalBlts]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spTotalBlts]

	@valor int

AS
BEGIN
	SET NOCOUNT ON;

IF (SELECT COUNT(*) FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal retOPe ON retOp.id = retOPe.idRet AND retOPe.idIngreso = @valor AND retOp.estadoRet>=1
)>=1

SELECT SUM(retOPe.bultos) AS 'sumaBultos' , SUM(retOPe.totalValorCif) AS 'sumaCif', SUM(retOPe.valorImpuesto) AS 'sumaImpts' 
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal retOPe ON retOp.id = retOPe.idRet AND retOPe.idIngreso = @valor
AND retOp.estadoRet>=1



END


GO
/****** Object:  StoredProcedure [dbo].[spTotalIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spTotalIng]

	@valor int

AS
BEGIN
	SET NOCOUNT ON;

	SELECT bultos, totalValorCif, valorImpuesto FROM valoresIngOpFiscal WHERE idIngreso = @valor
END


GO
/****** Object:  StoredProcedure [dbo].[spTpCambioDia]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spTpCambioDia]
	@tipoCambio float,
	@fechaCambio date

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tipoDeCambio
DECLARE @contador INT
SET @contador = (SELECT ISNULL(COUNT(*),0) FROM tipoCambio WHERE fechaCambio like '13-05-2020')
select @contador
IF (@contador=0)
BEGIN

 INSERT INTO [dbo].[tipoCambio]
           ([tipoCambio]
           ,[fechaCambio])
     VALUES
           (@tipoCambio
           ,@fechaCambio)

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tipoDeCambio
SELECT @error 'resp'
END
ELSE
BEGIN
COMMIT TRAN tipoDeCambio
SELECT 1 'resp'
END

END
END

GO
/****** Object:  StoredProcedure [dbo].[spTrasladoAf]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spTrasladoAf]
	@tipoAlmacen text,
	@idBodega int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia int
SET @dependencia = (SELECT  dependencia FROM bodegas WHERE id  = @idBodega)

select
round(sum(val.totalValorCif),2) as 'cifTraslado', round(sum(val.valorImpuesto),2) as 'impuestoTraslado',
@dependencia as 'dependencia'
from inventarioFiscal inv
INNER JOIN ingresoOperacionFiscal ing on ing.id = inv.idIngreso
INNER JOIN valoresIngOpFiscal val ON val.idIngreso = ing.id
INNER JOIN bodegas on bodegas.id = ing.identBodega and bodegas.dependencia = @dependencia
AND inv.tipo like @tipoAlmacen

END


GO
/****** Object:  StoredProcedure [dbo].[spTrasladoFiscal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spTrasladoFiscal]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranInve

UPDATE inventarioFiscal
SET tipo = 'AF'
WHERE idIngreso = @valor

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranInve
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranInve
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spTrasladoFiscalDef]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spTrasladoFiscalDef]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranInve

UPDATE inventarioFiscal
SET tipo = 'ALMFISCAL'
WHERE idIngreso = @valor

SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranInve
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranInve
SELECT 1 'resp'
END

END


GO
/****** Object:  StoredProcedure [dbo].[spTrasladoVeh]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spTrasladoVeh]
@idRet int,
@idChasis int,
@cif float,
@impts float,
@valUnitario float,
@idUsuario int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranTraslado 
DECLARE @chasCont INT
SET @chasCont = (SELECT count(*) FROM trasladoFiscalVeh WHERE chasis = @idChasis)
IF (@chasCont=0)
BEGIN
INSERT INTO [dbo].[trasladoFiscalVeh]
           ([idRet]
           ,[chasis]
           ,[cantidad]
           ,[cif]
           ,[impuesto]
           ,[valUnitario]
           ,[fechaEmision]
           ,[idUsuario]
           ,[estado])
     VALUES
           (@idRet
           ,@idChasis
           ,1
		   ,@cif
		   ,@impts
           ,@valUnitario
           ,getdate()
           ,@idUsuario
           ,0)
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranTraslado
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranTraslado
SELECT 1 'resp'
END
END
END
GO
/****** Object:  StoredProcedure [dbo].[spTServicios]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spTServicios]
	AS
BEGIN
	SET NOCOUNT ON;

select id AS 'identy',  servicio AS 'servicio' from SERVICIOS WHERE tipoAlmacenaje LIKE 'Af' OR tipoAlmacenaje LIKE 'Ac'


END


GO
/****** Object:  StoredProcedure [dbo].[spUbica]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spUbica]
	@valor int,
    @pasillo int,
    @columna int,
    @estado int,
	@idArea int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranUbica
INSERT INTO [dbo].[UBICACIONES]
           ([idIncidencia]
           ,[pasY]
           ,[ColX]
		   ,[idAreaBodega]
		   ,[estado])
     VALUES
	 (@valor,
@pasillo,
@columna,
@idArea,
@estado)

SET @error = @@ERROR

IF	(@error!=0)
BEGIN
ROLLBACK TRAN tranUbica
SELECT 0 
END
ELSE
BEGIN 
COMMIT TRAN tranUbica
SELECT 1
END
END


GO
/****** Object:  StoredProcedure [dbo].[spUbicacionVehUsado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spUbicacionVehUsado]

@idDetalle int,
@ubicacion int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN tranVehUsados

update vehiculosUsados
set ubicacionPredio = @ubicacion
where idDetalle = @idDetalle

DECLARE @idIng  INT
SET @idIng = (SELECT idIngreso FROM detalleDeMercaderia where id = @idDetalle)
DECLARE @detalleVeh int
SET @detalleVeh = (SELECT COUNT(*) FROM vehiculosUsados WHERE idIngreso = @idIng)
DECLARE @incidenciaMer INT
SET @incidenciaMer = (SELECT COUNT(*) FROM incidencia WHERE idIngreso = @idIng)

DECLARE @estadoIng int

IF (@detalleVeh = @incidenciaMer)
BEGIN
UPDATE ingresoOperacionFiscal 
SET estadoIngreso = estadoIngreso+1
WHERE id = @idIng
SET @estadoIng = 2
END
ELSE
BEGIN
SET @estadoIng = 1
END

set @error = @@ERROR

IF (@error<>0)
BEGIN
ROLLBACK TRAN tranVehUsados
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranVehUsados
SELECT @estadoIng AS 'resp'
END


END
GO
/****** Object:  StoredProcedure [dbo].[spUbicaData]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spUbicaData]
@idDetalle int
AS
BEGIN
	SET NOCOUNT ON;


SELECT inci.id AS 'Idincidencia', ingOp.identBodega AS 'idBodega', nt.nombreEmpresa AS 'consolidado',
ingOp.id AS 'identifica', ingOp.numeroPoliza AS 'poliza', detM.empresa AS 'clienteEmpresa', detM.bultos AS 'blts',
detM.peso AS 'dimPeso', inci.descripcionMercaderia AS 'detalleM', inci.stockPos AS 'pos', inci.stockMts AS 'mts',
ubica.pasY AS 'pasillo', ubica.ColX AS 'columna', detM.id AS 'idDetalle'	
FROM detalleDeMercaderia detM 
INNER JOIN incidencia inci ON inci.idDetalle = detM.id
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = detM.idIngreso
INNER JOIN nit nt ON nt.id = ingOp.idNit
INNER JOIN ubicaciones ubica ON inci.id = ubica.idIncidencia AND ubica.estado = 1 AND detM.id = @idDetalle

END
GO
/****** Object:  StoredProcedure [dbo].[spUbicaDetalle]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spUbicaDetalle]
@idDetalle int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idIncidencia int
SET @idIncidencia = (select id from incidencia where idDetalle = @idDetalle)

SELECT ub.id as 'idUbi', ub.ColX AS 'columnaX', ub.pasY AS 'pasilloY', ingOp.identBodega FROM ubicaciones ub 
INNER JOIN incidencia inci ON inci.id = ub.idIncidencia AND idIncidencia = @idIncidencia
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = inci.idIngreso AND ub.estado = 1
 


END


GO
/****** Object:  StoredProcedure [dbo].[spUbicaRetiro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spUbicaRetiro]

@idDetalle int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT inci.id AS 'idUbicacion', ubi.pasY AS 'pasillo', ubi.ColX AS 'columna' FROM ubicaciones ubi 
INNER JOIN incidencia inci ON ubi.idIncidencia = inci.id AND inci.idDetalle = @idDetalle and ubi.estado = 1



END


GO
/****** Object:  StoredProcedure [dbo].[spUbicSld]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spUbicSld]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT ubica.id AS 'idBodega', ing.id AS 'identifica', ing.numeroPoliza AS 'poliza', deta.empresa AS 'clienteEmpresa', deta.bultos AS 'blts', deta.peso
AS 'dimPeso', inci.descripcionMercaderia AS
'detalleM', inci.posiciones AS 'pos', inci.metros AS 'mts', ubica.pasY AS 'pasillo', ubica.ColX AS 'columna' FROM BODEGAS bod
INNER JOIN ingresoOperacionFiscal ing ON bod.id=@valor  AND ing.identBodega = @valor 
INNER JOIN detalleDeMercaderia deta ON ing.id = deta.idIngreso
INNER JOIN incidencia inci ON deta.id = inci.idDetalle 
INNER JOIN UBICACIONES ubica ON ubica.idIncidencia = inci.id
INNER JOIN valoresIngOpFiscal sldF ON sldF.idIngreso = ing.id AND sldF.estadoSaldo = 1 AND ubica.estado = 1



END


GO
/****** Object:  StoredProcedure [dbo].[spUnidadConsPol]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO













CREATE PROCEDURE [dbo].[spUnidadConsPol]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

select pilotos.licencia, pilotos.piloto, unidadesPlacas.placa, unidadesContenedores.contenedor, dat.marchamo, ingC.idConsolidado from datosUnidades dat
inner join ingresosConsolidadoPoliza ingC ON ingC.idIngreso = dat.idOp and tipoOp = 1
INNER JOIN pilotos ON pilotos.id = dat.piloto
inner join unidadesPlacas on unidadesPlacas.id = dat.unidadPlaca
inner join unidadesContenedores on unidadesContenedores.id = dat.unidadContenedor
WHERE dat.idOp = @valor and dat.tipoOp = 1

END


GO
/****** Object:  StoredProcedure [dbo].[spUnidadesRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spUnidadesRet]
@licencia text,
@piloto text,
@placa text,
@contenedores text,
@ret int

	AS
BEGIN
	SET NOCOUNT ON;


DECLARE @pilotoiD INT
SET @pilotoiD = ISNULL((SELECT TOP 1 (id) FROM pilotos WHERE licencia LIKE @licencia),0)

IF (@pilotoiD=0)
BEGIN
EXECUTE spRetPlto @licencia, @piloto
END

DECLARE @idContenedores INT
SET @idContenedores = ISNULL((SELECT TOP 1 (id) FROM unidadesContenedores WHERE contenedor LIKE @contenedores),0)

IF (@idContenedores=0)
BEGIN
EXECUTE spCreateCont @contenedores
END

DECLARE @placaId INT
SET @placaId = ISNULL((SELECT TOP 1 (id) FROM unidadesPlacas WHERE placa LIKE @placa),0)
IF (@placaId=0)
BEGIN
EXECUTE spCreatePlaca @placa
END

SET @pilotoiD = ISNULL((SELECT TOP 1 (id) FROM pilotos WHERE licencia LIKE @licencia),0)
SET @placaId = ISNULL((SELECT TOP 1 (id) FROM unidadesPlacas WHERE placa LIKE @placa),0)
SET @idContenedores = ISNULL((SELECT TOP 1 (id) FROM unidadesContenedores WHERE contenedor LIKE 'CAMION'),0)

DECLARE @idOperacion INT
SET @idOperacion = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RETIRO')


EXECUTE spInsUnidades @ret, @pilotoiD, @placaId, @idContenedores, 2, '0'

END
GO
/****** Object:  StoredProcedure [dbo].[spUpdateAreaBod]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spUpdateAreaBod]
@area text,
@desc text,
@fechaVen date,
@idBod int,
@idArea int


	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranUpdateArea

UPDATE areasBodegas SET nombreArea = @area, descripcionArea = @desc, tiempo = 1, fechaVencimiento = @fechaVen WHERE id = @idArea

SET @error = @@ERROR

IF (@error!=0)
BEGIN
ROLLBACK TRAN tranUpdateArea
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranUpdateArea
SELECT 1 'resp'
END



END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateBaseCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spUpdateBaseCalculo]
	@calculoSobre text,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE ALMACENAJES
SET baseCalculo=@calculoSobre
WHERE idTarifa=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateBaseGstosAdmin]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spUpdateBaseGstosAdmin]
	@calculoSobre text,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE GASTOS_ADMIN
SET basegastosAdmin=@calculoSobre
WHERE idgastosAdmin=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateBaseManejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spUpdateBaseManejo]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE MANEJO
SET baseManejo=@nuevoDato
WHERE idManejo=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateBaseMoneda]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spUpdateBaseMoneda]
	@calculoSobre text,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE GASTOS_ADMIN
SET monedaCalculo=@calculoSobre
WHERE idgastosAdmin=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateBaseOtros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spUpdateBaseOtros]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE OTROS_GASTOS
SET baseotrosGastos=@nuevoDato
WHERE idotrosGastos=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateBltsDetIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spUpdateBltsDetIng]
@idDetalle int,
@bultos int,
@peso float

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranUpdateRet
DECLARE @saldoBultos int
set @saldoBultos = (SELECT stock FROM detalleDeMercaderia WHERE id = @idDetalle)

IF (@saldoBultos>0)
BEGIN 

DECLARE @bltsAnt INT
SET @bltsAnt = (SELECT bultos FROM detalleDeMercaderia WHERE id = @idDetalle)
DECLARE @sumAlgebraBlts INT
SET @sumAlgebraBlts = (@bltsAnt-1630)
DECLARE @newStock INT
IF	(@sumAlgebraBlts>0)
BEGIN
SET @newStock = (@saldoBultos-@sumAlgebraBlts)
END
IF	(@sumAlgebraBlts<0)
BEGIN
SET @newStock = (@saldoBultos+@sumAlgebraBlts)
END

UPDATE detalleDeMercaderia 
SET bultos = @bultos, stock = @newStock, peso = @peso
WHERE id=@idDetalle
END

DECLARE @idIng INT
SET @idIng = (SELECT idIngreso FROM detalleDeMercaderia WHERE id = @idDetalle)
DECLARE @stock INT
SET @stock =(SELECT SUM(bultos) FROM detalleDeMercaderia WHERE idIngreso = @idIng)

set @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranUpdateRet
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranUpdateRet
SELECT @stock 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateBltsIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spUpdateBltsIng]
@idIng int,
@bultos int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranUpdateRet

UPDATE valoresIngOpFiscal
SET bultos = @bultos
WHERE idIngreso = @idIng

UPDATE inventarioFiscal
SET saldoBultos = @bultos
WHERE idIngreso = @idIng


set @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN tranUpdateRet
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranUpdateRet
SELECT 1 'resp'
END


END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateCalculoSobre]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spUpdateCalculoSobre]
	@calculoSobre text,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE ALMACENAJES
SET calculoSobre=@calculoSobre
WHERE idTarifa=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateChasis]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spUpdateChasis]
	@idChas int,
	@idRet int
AS
BEGIN
	SET NOCOUNT ON;

UPDATE chasisVehiculosNuevos
SET estado = 2, idRet = @idRet
WHERE id = @idChas




END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateCont]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spUpdateCont]

	@date datetime,
		@valor int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
BEGIN TRAN

UPDATE historialIngreso
SET estadoIngreso = 2,
fechaBod = @date,
comentarios = 'Culminado Bodega'
WHERE idOp=@valor

SET @error = @@ERROR
IF	(@error<>0)
BEGIN
ROLLBACK TRAN
END
ELSE
BEGIN
EXECUTE spContaIng @valor
COMMIT TRAN
END



END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateDetalle]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spUpdateDetalle]

	@idRet int,
	@usuario int
AS
BEGIN
	SET NOCOUNT ON;
DECLARE @estadoRet int
set @estadoRet = (SELECT estadoRet FROM retiroOperacionFiscal WHERE id = @idRet)
DECLARE @countRet INT
SET @countRet = (SELECT ISNULL(COUNT(*),0) FROM datosUnidades WHERE idOp = @idRet AND tipoOp = 2 AND estado = 2)

DECLARE @fecha datetime
SET @fecha = (SELECT fechaEmision FROM retiroOperacionFiscal WHERE id = @idRet)
DECLARE @vehUs INT
SET @vehUs = (SELECT ISNULL(COUNT(*),0) FROM vehiculosUsados WHERE  idIngreso = (SELECT idIngresosOP FROM retiroOperacionFiscal WHERE id = @idRet))

IF (@countRet>=1 OR @vehUs>=1)
BEGIN
DECLARE @error INT

BEGIN TRAN tranCambioEstd
IF (@vehUs>=1)
BEGIN
UPDATE retiroOperacionFiscal 
SET estadoRet = estadoRet+1 
WHERE id = @idRet
END




/*LA FECHA ES UN PARAMETRO DE BITACORA, YA QUE SINO SE MANDA GENERA UN ERROR EL STORE PRODUCE*/
EXECUTE spBitacoraRet @idRet, 'Rebaja POS MTS', @usuario,  1, @fecha;	
SET @error = @@ERROR
IF (@error<>0)
BEGIN
ROLLBACK TRAN tranCambioEstd
SELECT 0 AS 'resp'
END
ELSE
BEGIN
COMMIT TRAN tranCambioEstd
SELECT 1 AS 'resp'
END
END
ELSE
BEGIN
/*LA FECHA ES UN PARAMETRO DE BITACORA, YA QUE SINO SE MANDA GENERA UN ERROR EL STORE PRODUCE*/
EXECUTE spBitacoraRet @idRet, 'Rebaja POS MTS', @usuario,  1, @fecha;	
SELECT 2 'resp'
END

END
GO
/****** Object:  StoredProcedure [dbo].[spUpdateEstadoDet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spUpdateEstadoDet]
	@idIng int,
	@detalle int,
	@usuario int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE detalleDeMercaderia
SET estado = 1
WHERE id = @detalle

DECLARE @vehUs int
set @vehUs = (SELECT COUNT(*) FROM vehiculosUsados WHERE idIngreso = @idIng)
IF (@vehUs=0)
BEGIN
EXECUTE spUpdateIngEstado @idIng
END

EXECUTE spContaIng @idIng
EXECUTE spBitacoraIng @idIng, 'Culminar Ingreso', @usuario, 1

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateEstadoDeta]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spUpdateEstadoDeta]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


UPDATE detalleDeMercaderia
SET estado = 1
WHERE id = @valor


END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spUpdateIng]
	@idIng int

AS
BEGIN

UPDATE ingresoOperacionFiscal
SET estadoIngreso = estadoIngreso+1
WHERE id=@idIng

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateIngCons]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spUpdateIngCons]
@ing int
	AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error INT
DECLARE @estadoIng INT
SET @estadoIng = (SELECT estadoIngreso FROM ingresoOperacionFiscal WHERE id = @ing)
IF(@estadoIng=3)
BEGIN
BEGIN TRAN transCons
DECLARE @consoPol int
SET @consoPol = (select ISNULL(COUNT(*), 0) from ingresosConsolidadoPoliza where idIngreso = @ing)
IF (@consoPol>=1)
BEGIN
DECLARE @paseSal INT
SET @paseSal = (SELECT ISNULL(COUNT(*), 0) FROM pasesDeSalida paseSa
inner join datosUnidades dt ON dt.id = paseSa.idUnidad
inner join ingresosConsolidadoPoliza ingC ON ingC.idIngreso = dt.idOp and dt.estado = 1 and dt.estado = 1
where ingC.idIngreso = @ing)

DECLARE @datosUnidad INT
SET @datosUnidad = (SELECT ISNULL(COUNT(*), 0) FROM datosUnidades dt
inner join ingresosConsolidadoPoliza ingC ON ingC.idIngreso = dt.idOp and dt.estado = 1 and dt.estado = 1
where ingC.idIngreso = @ing)

DECLARE @cadena char(32);  
SET @cadena = (select cadenaVinculo from ingresosConsolidadoPoliza WHERE idIngreso = @ing)
DECLARE @resp int

DECLARE @cantPol int
SET @cantPol = (SELECT COUNT(*) FROM 
ingresoOperacionFiscal ing
inner join ingresosConsolidadoPoliza ingC ON ingC.idIngreso = ing.id and ing.estadoIngreso >=1
WHERE ingC.cadenaVinculo LIKE @cadena)

DECLARE @cantInci INT
SET @cantInci = (SELECT COUNT(*) FROM incidencia inc 
inner join ingresoOperacionFiscal ing on inc.idIngreso  = ing.id
inner join ingresosConsolidadoPoliza ingC ON ingC.idIngreso = ing.id and ing.estadoIngreso >=1
WHERE ingC.cadenaVinculo LIKE @cadena)

IF (@paseSal=@datosUnidad AND @cantInci = @cantPol)
BEGIN
UPDATE ingresoOperacionFiscal
SET estadoIngreso = 4
FROM
ingresoOperacionFiscal ing
inner join ingresosConsolidadoPoliza ingC ON ingC.idIngreso = ing.id and ing.estadoIngreso >=1
WHERE ingC.cadenaVinculo LIKE @cadena
SET @resp = 1
END
ELSE
BEGIN
SET @resp = 3
END


END
SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN transCons
SELECT 0 'resp';
END
ELSE
BEGIN
COMMIT TRAN transCons
SELECT @resp 'resp';
END

END
ELSE
BEGIN
SELECT 2 'resp';

END

END
GO
/****** Object:  StoredProcedure [dbo].[spUpdateIngEstado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spUpdateIngEstado]
@idIng int
AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error INT
BEGIN TRAN tranEstadoIng

UPDATE ingresoOperacionFiscal
SET estadoIngreso = estadoIngreso+1
WHERE id = @idIng

SET @error = @@ERROR
IF (@error <>0)
BEGIN
ROLLBACK TRAN tranEstadoIng
END
ELSE
BEGIN
COMMIT TRAN tranEstadoIng
END

END
GO
/****** Object:  StoredProcedure [dbo].[spUpdateMoneda]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spUpdateMoneda]
	@calculoSobre text,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE ALMACENAJES
SET Moneda=@calculoSobre
WHERE idTarifa=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateMonedaCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spUpdateMonedaCalculo]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE SEGURO
SET monedaCalculo=@nuevoDato
WHERE idSeguro=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateMonedaManejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spUpdateMonedaManejo]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE MANEJO
SET monedaCalculo=@nuevoDato
WHERE idManejo=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateMonedaOtros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spUpdateMonedaOtros]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE OTROS_GASTOS
SET monedaCalculo=@nuevoDato
WHERE idotrosGastos=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdatePeriodo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spUpdatePeriodo]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE SEGURO
SET periodoCalculo=@nuevoDato
WHERE idSeguro=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdatePeriodoCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spUpdatePeriodoCalculo]
	@calculoSobre text,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE ALMACENAJES
SET periodoCalculo=@calculoSobre
WHERE idTarifa=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdatePrdoCalculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spUpdatePrdoCalculo]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE SEGURO
SET periodoCalculo=@nuevoDato
WHERE idSeguro=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateSeguroSobre]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spUpdateSeguroSobre]
	@nuevoDato text,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE SEGURO
SET periodSeguro=@nuevoDato
WHERE idSeguro=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateUbicaChas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spUpdateUbicaChas]
@idChas int,
@idUbicacion int

	AS
BEGIN
	SET NOCOUNT ON;

UPDATE chasisVehiculosNuevos
SET estado = 1, ubicacion = @idUbicacion
WHERE id = @idChas


END
GO
/****** Object:  StoredProcedure [dbo].[spUpdateValor]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spUpdateValor]
	@calculoSobre float,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE ALMACENAJES
SET valorTarifa=@calculoSobre
WHERE idTarifa=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateValorGtsAdmin]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spUpdateValorGtsAdmin]
	@calculoSobre float,
	@idTarifa int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE GASTOS_ADMIN
SET valorgastosAdmin=@calculoSobre
WHERE idgastosAdmin=@idTarifa

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateValorManejo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spUpdateValorManejo]
	@nuevoDato float,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE MANEJO
SET valorManejo=@nuevoDato
WHERE idManejo=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateValorOtros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spUpdateValorOtros]
	@nuevoDato int,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE OTROS_GASTOS
SET valorotrosGastos=@nuevoDato
WHERE idotrosGastos=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUpdateVlrSeguro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spUpdateVlrSeguro]
	@nuevoDato float,
	@idSeguro int
AS
BEGIN
	SET NOCOUNT ON;


UPDATE SEGURO
SET valorSeguro=@nuevoDato
WHERE idSeguro=@idSeguro

END


GO
/****** Object:  StoredProcedure [dbo].[spUsuarioOP]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spUsuarioOP]
@idRet int

	AS
BEGIN
	SET NOCOUNT ON;

select 
personal.nombres, personal.apellidos, ISNULL(personal.foto, 'NA') as 'foto', personal.id,
personal.email, personal.telefono
from bitacoraRetiroCalculo bitacora
inner join retiroOperacionFiscal retOpF ON retOpF.id = bitacora.idOpera AND bitacora.tipo = 1 AND bitacora.transaccion LIKE 'Nuevo Retiro' AND retOpF.id = @idRet
inner join personal ON personal.id = bitacora.idUsuario
END


GO
/****** Object:  StoredProcedure [dbo].[spUsuarioTarifa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spUsuarioTarifa]
	@valor  int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @usuario int
SET @usuario = (select idUsuarioCliente from ingresoOperacionFiscal WHERE id = @valor)
SELECT @usuario AS	'tipoUsuario'
END
GO
/****** Object:  StoredProcedure [dbo].[spValAnulacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spValAnulacion]
@idIngreso int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @error int
BEGIN TRAN tranSQL
DECLARE @resp int
DECLARE @estado int
set @estado = (select estadoIngreso from ingresoOperacionFiscal where id = @idIngreso)

IF (@estado>=4)
BEGIN

DECLARE @token int
SET @token = (SELECT COUNT(*) from autoDeAnulaIng where idIngreso = @idIngreso and estado = 1)
IF (@token>=1)

BEGIN
UPDATE ingresoOperacionFiscal 
SET estadoIngreso = -1, numeroPoliza = CONCAT(numeroPoliza, 'ANL') 
WHERE id = @idIngreso
set @resp = 1
END
ELSE
BEGIN
set @resp = 0
END
END

IF (@estado<=3)
BEGIN

UPDATE ingresoOperacionFiscal 
SET estadoIngreso = -1, numeroPoliza = CONCAT(numeroPoliza, 'ANL') 
WHERE id = @idIngreso
set @resp = 1
END
SET @error = @@ERROR

IF(@error!=0)
BEGIN
ROLLBACK TRAN tranSQL
SELECT 0 'resp', @resp as 'respAnul'
END
ELSE
BEGIN
COMMIT TRAN tranSQL
SELECT 1 'resp', @resp as 'respAnul'
END


END
GO
/****** Object:  StoredProcedure [dbo].[spValCadenaIng]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spValCadenaIng]
	@idIng int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @cadena char(32)
SET @cadena = (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIng)

SELECT cadenaVinculo AS 'cadena', estadoOperacion AS 'operacion', idIngreso AS 'ingreso' FROM ingresosConsolidadoPoliza WHERE cadenaVinculo LIKE @cadena

END
GO
/****** Object:  StoredProcedure [dbo].[spValCadenaIngPasV]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spValCadenaIngPasV]
	@idIng int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @cadena char(32)
SET @cadena = (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIng)

SELECT cadenaVinculo AS 'cadena', estadoOperacion AS 'operacion', idIngreso AS 'ingreso' FROM ingresosConsolidadoPoliza ingCons
INNER JOIN datosUnidades datUn ON datUn.idOp = ingCons.idIngreso AND ingCons.cadenaVinculo LIKE @cadena
INNER JOIN pasesDeSalida pasSal ON pasSal.idUnidad = datUn.id


END
GO
/****** Object:  StoredProcedure [dbo].[spValChasis]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spValChasis]
	@tipoVehParam text,
	@lineaParam text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @tipoV int
SET  @tipoV = (SELECT id FROM tiposDeVehiculos WHERE tipoVehiculo LIKE @tipoVehParam)

SELECT COUNT(*) AS 'incidenciaChasis' FROM medidasVehiculos mdV
INNER JOIN tiposDeVehiculos tpV ON mdV.idTipoVeh = tpV.id AND tpV.id = @tipoV AND mdV.linea LIKE @lineaParam

END


GO
/****** Object:  StoredProcedure [dbo].[spValChasisSimilar]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spValChasisSimilar]
	@tipoVehParam text,
	@lineaParam text

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @tipoV int
SET  @tipoV = (SELECT id FROM tiposDeVehiculos WHERE tipoVehiculo LIKE @tipoVehParam)

SELECT COUNT(*) AS 'incidenciaChasis' FROM medidasVehiculos mdV
INNER JOIN tiposDeVehiculos tpV ON mdV.idTipoVeh = tpV.id AND tpV.id = @tipoV AND mdV.linea LIKE CONCAT('%',@lineaParam,'%')

END


GO
/****** Object:  StoredProcedure [dbo].[spValContaRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spValContaRet]
@poliza text
,@idRet int
,@bultos int
,@valDolares float
,@cif float
,@impuesto float

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idIng INT
SET @idIng = (SELECT ISNULL(id,0) FROM ingresoOperacionFiscal WHERE numeroPoliza like @poliza)



IF (@idIng>=1)
BEGIN
UPDATE valoresRetirosFiscal
SET estadoSaldo = 2
WHERE idRet = @idRet and idIngreso = @idIng
INSERT INTO [dbo].[valoresPolizaDR]
	([idIng]
		,[idRet]
		,[bultos]
		,[valDolares]
		,[cif]
		,[impuesto])
   VALUES
    (@idIng
		,@idRet
		,@bultos
		,@valDolares
		,@cif
		,@impuesto)
END
EXECUTE spStockGeneral @idIng
END
GO
/****** Object:  StoredProcedure [dbo].[spValidaCobro]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spValidaCobro]
@idRetiro int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @validacionOp int
SET @validacionOp = (SELECT ISNULL(COUNT(*), 0) FROM registroDeCobros WHERE idRetiro = @idRetiro AND estado = 1) 
SELECT @validacionOp AS 'valiCobro'


END

GO
/****** Object:  StoredProcedure [dbo].[spvalidarCntServicio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spvalidarCntServicio]


AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(aplicaServicio)
FROM ALMACENAJES
WHERE aplicaServicio=1;

END


GO
/****** Object:  StoredProcedure [dbo].[spValidarCui]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO








CREATE PROCEDURE [dbo].[spValidarCui]
@idPiloto text,
@idIngreso int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idPLT int
SET @idPLT = (SELECT id FROM pilotos WHERE licencia LIKE @idPiloto)

SELECT ISNULL(COUNT(*), 0) AS 'countPilotos' FROM datosUnidades WHERE idOp = @idIngreso AND piloto = @idPLT

END

GO
/****** Object:  StoredProcedure [dbo].[spValNewUbica]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spValNewUbica]
@idChasis int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT estado FROM chasisVehiculosNuevos WHERE id = @idChasis


END
GO
/****** Object:  StoredProcedure [dbo].[spValoresContaRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spValoresContaRet]
@ident int

AS
BEGIN
	SET NOCOUNT ON;


SELECT ISNULL(SUM(valRet.totalValorCif),0) AS 'sumCifRet', 
ISNULL(SUM(valRet.valorImpuesto),0) AS 'sumImpt'
FROM retiroOperacionFiscal retOP
INNER JOIN valoresRetirosFiscal valRet ON valRet.idRet = retOP.id 
INNER JOIN ingresoOperacionFiscal ingOp ON retOP.idIngresosOP = ingOp.id and ingOp.identBodega = @ident
INNER JOIN inventarioFiscal inv ON inv.idIngreso = ingOp.id
AND retOP.estadoRet = 5 
WHERE inv.tipo IS NULL


END


GO
/****** Object:  StoredProcedure [dbo].[spValoresContaRetAF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spValoresContaRetAF]
@ident int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @dependencia INT
SET @dependencia = (SELECT dependencia FROM bodegas WHERE id = @ident)

SELECT ISNULL(SUM(valRet.totalValorCif),0) AS 'sumCifRet', 
ISNULL(SUM(valRet.valorImpuesto),0) AS 'sumImpt'
FROM retiroOperacionFiscal retOP
INNER JOIN valoresRetirosFiscal valRet ON valRet.idRet = retOP.id 
INNER JOIN ingresoOperacionFiscal ingOp ON retOP.idIngresosOP = ingOp.id 
INNER JOIN inventarioFiscal inv ON inv.idIngreso = ingOp.id
INNER JOIN bodegas ON bodegas.id = ingOp.identBodega and bodegas.dependencia = @dependencia
AND retOP.estadoRet = 5 
WHERE inv.tipo LIKE 'ALMACENFISCAL' OR inv.tipo LIKE 'ALMFISCAL' 

END


GO
/****** Object:  StoredProcedure [dbo].[spValoresDRRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spValoresDRRet]
@ret int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @inicioCorr INT
SET @inicioCorr = (SELECT numeroInicio FROM inicioCorrelativos)




select nit.nitEmpresa, nit.nombreEmpresa, ing.numeroPoliza, regimen.regimen,
asig.numeroAsignado+@inicioCorr AS 'numeroIngreso', valDR.bultos
from valoresPolizaDR valDR
INNER JOIN ingresoOperacionFiscal ing ON ing.id = valDR.idIng
INNER JOIN regimen on regimen.id = ing.regimen
INNER JOIN numAsignadoIngresos asig ON asig.idIng = valDR.idIng
INNER JOIN nit ON nit.id = ing.idNit
WHERE valDR.idRet = @ret




END
GO
/****** Object:  StoredProcedure [dbo].[spValoresPolizasDR]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spValoresPolizasDR]
	@id int

AS
BEGIN
	SET NOCOUNT ON;

select * from valoresPolizaDR where idRet = @id

END


GO
/****** Object:  StoredProcedure [dbo].[spValPaseSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spValPaseSalida]
	@idUnidad int

AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS  'estado' FROM pasesDeSalida WHERE idUnidad = @idUnidad

END


GO
/****** Object:  StoredProcedure [dbo].[spValStock]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spValStock]
@idIngreso int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @bultosDet int
SET @bultosDet = (SELECT ISNULL(SUM(bultos), 0) FROM detalleDeMercaderia WHERE idIngreso = @idIngreso)

DECLARE @pesoDet float
SET @pesoDet = (SELECT ISNULL(SUM(peso), 0) FROM detalleDeMercaderia WHERE idIngreso = @idIngreso)

DECLARE @pesoIng float
SET @pesoIng = (SELECT SUM(peso) FROM valoresIngOpFiscal WHERE idIngreso = @idIngreso)

DECLARE @bultosIng int
SET @bultosIng = (SELECT SUM(bultos) FROM valoresIngOpFiscal WHERE idIngreso = @idIngreso)

SELECT @bultosDet AS 'bultosAgregadosDet', @pesoDet AS 'pesosAgregadosDet', @bultosIng AS 'bultosIng', @pesoIng AS 'pesoIngreso'

END
GO
/****** Object:  StoredProcedure [dbo].[spValVinculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO









CREATE PROCEDURE [dbo].[spValVinculo]
@cadena text	

AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'countCadena' FROM ingresosConsolidadoPoliza WHERE cadenaVinculo LIKE @cadena
END

GO
/****** Object:  StoredProcedure [dbo].[spVehAutorizados]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spVehAutorizados]
	@ident int

AS
BEGIN
	SET NOCOUNT ON;

	SELECT 
	chasV.id AS 'ident',
	nt.nombreEmpresa, 
	chasV.chasis,
	ing.numeroPoliza,
	retV.polizaRetiro,
	retV.id AS 'ret', 
	tipV.tipoVehiculo,
	medV.linea,
	CONCAT('PREDIO ', prdV.predio, prdV.descripcion) AS 'predio',
	chasV.estado
	FROM chasisVehiculosNuevos chasV
	INNER JOIN ingresoOperacionFiscal ing ON chasV.idIngreso = ing.id AND ing.identBodega = @ident
	INNER JOIN retiroOperacionFVeh retV ON retV.id = chasV.idRet AND chasV.estado >=2
	INNER JOIN tiposDeVehiculos tipV ON tipV.id = chasV.tipoVehiculo
	INNER JOIN medidasVehiculos medV ON medV.id = chasV.lineaVehiculo
	INNER JOIN prediosDeVehiculos prdV ON prdV.id = chasV.ubicacion
	INNER JOIN nit nt ON nt.id = ing.idNit  
	ORDER BY convert(varchar(10),chasV.chasis,23), convert(varchar(10),tipV.tipoVehiculo,23), convert(varchar(10),medV.linea,23) 

END


GO
/****** Object:  StoredProcedure [dbo].[spVerBodegas]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spVerBodegas]
	@idBod int

	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @idEmpresa int
set @idEmpresa = (SELECT dependencia FROM bodegas WHERE id = @idBod)


SELECT bodegas.id, bodegas.areasAutorizadas, bodegas.numeroIdentidad, empresas.empresa 
FROM bodegas 
INNER JOIN empresas on empresas.id = bodegas.dependencia and bodegas.dependencia = @idEmpresa


END


GO
/****** Object:  StoredProcedure [dbo].[spVerCadena]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spVerCadena]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @ingreso int
SET @ingreso = (SELECT idOp FROM datosUnidades WHERE id = @valor AND tipoOp = 1)

DECLARE @cadena char(32)
SET @cadena = (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE idIngreso = @ingreso)

select  cadenaVinculo AS 'vinculo', estadoOperacion AS 'estado', idIngreso AS 'ingreso' from ingresosConsolidadoPoliza WHERE cadenaVinculo LIKE @cadena

END


GO
/****** Object:  StoredProcedure [dbo].[spVerCadenaSalida]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spVerCadenaSalida]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;
DECLARE @ingreso int
SET @ingreso = (SELECT idOp FROM datosUnidades WHERE id = @valor AND tipoOp = 1)

DECLARE @cadena char(32)
SET @cadena = (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE id = @ingreso)
select COUNT(*) AS 'cantPases' from ingresosConsolidadoPoliza ingCon
INNER JOIN datosUnidades dtUn ON dtUn.idOp = ingCon.idIngreso AND ingCon.tipoOperacion = 1
AND ingCon.cadenaVinculo LIKE @cadena
END


GO
/****** Object:  StoredProcedure [dbo].[spVerDescuentos]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spVerDescuentos]
@idCalculo INT
	AS
BEGIN
	SET NOCOUNT ON;


SELECT * FROM descuentosCalculos
WHERE idCalculo = @idCalculo


END
GO
/****** Object:  StoredProcedure [dbo].[spVerDetalleStockPOSM]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



create PROCEDURE [dbo].[spVerDetalleStockPOSM]
@posM int
	AS
BEGIN
	SET NOCOUNT ON;

SELECT empresa, stock, bultos, peso,

ing.numeroPoliza ,

posM.stockPos, posM.stockMetraje as 'stockMts'
FROM detalleDeMercaderia detM
INNER JOIN incidencia inc ON inc.idDetalle = detM.id
INNER JOIN ingresoOperacionFiscal ing ON ing.id = detM.idIngreso
INNER JOIN posMetrajeBod posM ON posM.idIncidencia = inc.id and posM.id = @posM


END


GO
/****** Object:  StoredProcedure [dbo].[spVerEstadoTreRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spVerEstadoTreRet]

	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
retOp.id AS 'idRetSuper'
FROM retiroOperacionFiscal retOp
INNER JOIN valoresRetirosFiscal saldRet ON retOp.id = saldRet.idRet AND (retOp.estadoRet >= 2) and (retOp.estadoRet <=3)
INNER JOIN nit nt ON nt.id = retOp.idNit
INNER JOIN ingresoOperacionFiscal ingOp ON ingOp.id = retOp.idIngresosOP
INNER JOIN bodegas on bodegas.id = ingOp.identBodega
INNER JOIN valoresIngOpFiscal saldIng ON saldIng.idIngreso = retOp.idIngresosOP
INNER JOIN servicios srv ON srv.id = ingOp.idServicio 
WHERE retOp.estadoRet = 3

		   

END
GO
/****** Object:  StoredProcedure [dbo].[spVerEstadoVehRet]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spVerEstadoVehRet]

@valor int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT 
chasisV.id, chasisV.chasis, tipV.tipoVehiculo, mdv.linea, prdV.predio, prdV.descripcion, chasisV.estado
FROM chasisVehiculosNuevos chasisV
LEFT JOIN medidasVehiculos mdv ON mdv.id = chasisV.lineaVehiculo
LEFT JOIN tiposDeVehiculos tipV ON tipV.id = chasisV.tipoVehiculo AND chasisV.estado >= 1
LEFT JOIN prediosDeVehiculos prdV ON prdV.id = chasisV.ubicacion
WHERE chasisV.idRet = @valor
END

GO
/****** Object:  StoredProcedure [dbo].[spVerIdCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spVerIdCalc]
@poliza text

	AS
BEGIN
	SET NOCOUNT ON;
SELECT id FROM calculosNormal WHERE poliza LIKE @poliza
END
GO
/****** Object:  StoredProcedure [dbo].[spVerificaCalc]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spVerificaCalc]
@idIng int,
@poliza text



	AS
BEGIN
	SET NOCOUNT ON;

SELECT COUNT(*) AS 'cantidadEstado' FROM calculosNormal WHERE poliza LIKE  @poliza and idIngreso = @idIng



END


GO
/****** Object:  StoredProcedure [dbo].[spVerificacion]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO










CREATE PROCEDURE [dbo].[spVerificacion]

@valor int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @saldoStock float
DECLARE @saldo float
SET @saldo = ISNULL((SELECT SUM(saldoBultos) FROM inventarioFiscal sldoInv WHERE sldoInv.idIngreso = @valor),0)

DECLARE @verCortes int
SET @verCortes = (SELECT COUNT(*) FROM registroDeCobrosFiscal WHERE idIngreso = @valor)

DECLARE @bultos int
SET @bultos = (SELECT bultos FROM valoresIngOpFiscal WHERE idIngreso = @valor)

DECLARE @ret int
SET @ret = (SELECT COUNT(*) FROM retiroOperacionFiscal WHERE idIngresosOP = @valor)


SELECT @saldo AS 'stock', @verCortes AS 'numCorte', @bultos AS 'bultosIngreso', @ret AS 'retirosCant'

END


GO
/****** Object:  StoredProcedure [dbo].[spVerificacionVinculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO











CREATE PROCEDURE [dbo].[spVerificacionVinculo]

@idIngreso int

	AS
BEGIN
	SET NOCOUNT ON;

SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIngreso

END


GO
/****** Object:  StoredProcedure [dbo].[spVerificarCorteRec]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO







CREATE PROCEDURE [dbo].[spVerificarCorteRec]
	@idIngreso int

AS
BEGIN
	SET NOCOUNT ON;

SELECT MAX(convert(varchar(10),fechaRetiro,23)) AS 'fechaRetiro' FROM registroDeCobrosFiscal WHERE idIngreso = @idIngreso

END


GO
/****** Object:  StoredProcedure [dbo].[spVerificarEstado]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spVerificarEstado]
	@idIncidencia int

AS
BEGIN
	SET NOCOUNT ON;


select COUNT(*) AS 'cantUbicaciones' from ubicaciones WHERE idIncidencia = @idIncidencia AND estado=1

END


GO
/****** Object:  StoredProcedure [dbo].[spVerificarTarCal]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spVerificarTarCal]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;


DECLARE @idNT int
SET @idNT = (SELECT idNit FROM ingresoOperacionFiscal WHERE id=@valor)

EXECUTE spVerificaTarifa @idNT

END


GO
/****** Object:  StoredProcedure [dbo].[spVerificaTarifa]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spVerificaTarifa]
@identIng int,
@identRet int
	AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @retAsignado INT
SET	@retAsignado = 0
IF (@identRet>=1)
BEGIN
DECLARE @idNombreCorrel INT
SET @idNombreCorrel = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RETIRO')
DECLARE @idIng INT
SET @idIng = (SELECT ing.id FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @identRet)
DECLARE @idIdenty INT
SET @idIdenty = (SELECT ing.identBodega FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @identRet)
DECLARE @categoria INT
SET @categoria = (SELECT id FROM vinculosDeBodegas WHERE idBodega = @idIdenty)
	DECLARE @inicioCor INT
	SET @inicioCor = (SELECT numeroInicio FROM inicioCorrelativos)

SET @retAsignado = ISNULL((SELECT numeroAsignado FROM numAsignadoRetiros WHERE idRet = @identRet AND idIng = @idIng AND idIdent = @idIdenty), 0)
	DECLARE @estadoRetAs INT

	SET @estadoRetAs  = (SELECT estadoRet FROM retiroOperacionFiscal WHERE id = @identRet)

DECLARE @retAsignadoReci INT
SET @retAsignadoReci = ISNULL((SELECT numeroAsignado FROM numAsignadoRecibos WHERE idRet = @identRet AND idIng = @idIng AND idIdent = @idIdenty), 0)

END
ELSE
BEGIN
SET @retAsignado = 0

END

DECLARE @idNombreCorrels INT
SET @idNombreCorrels = (SELECT id FROM nombresCorrelativos WHERE nombreCorrelativo LIKE 'RETIRO')

DECLARE @idIdentys INT
SET @idIdentys = (SELECT ing.identBodega FROM retiroOperacionFiscal ret INNER JOIN ingresoOperacionFiscal ing ON ret.idIngresosOP = ing.id AND  ret.id = @identRet)
DECLARE @categorias INT
SET @categorias = (SELECT id FROM vinculosDeBodegas WHERE id = @idIdentys)

DECLARE @estdCorrelativo INT
SET @estdCorrelativo = (SELECT COUNT(*) FROM numeradorCorrelativos WHERE idCategoria = @categorias AND idnomCorrelativo = @idNombreCorrels)


DECLARE @retAsignadoRecis INT
SET @retAsignadoRecis = ISNULL((SELECT numeroAsignado FROM numAsignadoRecibos WHERE idRet = @identRet AND idIng = @idIng AND idIdent = @idIdenty), 0)

DECLARE @tarifaEspecial int
SET @tarifaEspecial = (SELECT COUNT(*) FROM ingresoOperacionFiscal ing INNER JOIN USUARIOSEXTERNOS usx ON ing.idUsuarioCliente = usx.id AND ing.id=@identIng)
DECLARE @estadoSinTarifa int
SET @estadoSinTarifa = (SELECT COUNT(*) FROM ingresoOperacionFiscal ing INNER JOIN clientesSinTarifa clST ON ing.id=clST.idIngreso AND ing.id=@identIng AND clST.estado <=2) 
DECLARE @tarifaNormal int
SET @tarifaNormal = (SELECT COUNT(*) FROM ingresoOperacionFiscal ing INNER JOIN tarifasNormales trN ON ing.idNit LIKE trN.Dependencia_Nit AND ing.idNit LIKE trN.Dependencia_Nit AND  ing.id=@identIng) 
DECLARE @idNit int
SET @idNit = (SELECT idNit FROM ingresoOperacionFiscal WHERE id = @identIng)
DECLARE @generalEspecial int
SET @generalEspecial = (SELECT COUNT(*)  FROM tarifasNormales WHERE Dependencia_Nit LIKE (CAST(@idNit AS varchar(10))))
DECLARE @idUser int
SET @idUser = (SELECT idUsuarioCliente FROM ingresoOperacionFiscal WHERE id = @identIng)
DECLARE @serv varchar(50)
SET @serv = (SELECT ser.servicio FROM ingresoOperacionFiscal ing INNER JOIN servicios ser ON ing.idServicio = ser.id AND ing.id = @identIng)
DECLARE @suma int
SET @suma = SUM(@tarifaEspecial+@estadoSinTarifa+@generalEspecial+@generalEspecial)
SELECT @tarifaEspecial  AS 'tarifaEspecial', @estadoSinTarifa AS 'estadoTarifa', @tarifaNormal AS 'tarifaNormal', @generalEspecial AS 'generalZA', @suma AS 'aplica', @serv AS 'srvCliente', @idUser AS 'idUser', @retAsignado AS 'retAsignado', @retAsignadoRecis AS 'reciboAsignado',
@estadoRetAs 'estadoRet', @inicioCor AS 'inicioCorrelativo'




END


GO
/****** Object:  StoredProcedure [dbo].[spVerificaVehNew]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO




CREATE PROCEDURE [dbo].[spVerificaVehNew]
@idIng int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @igBultos int
SET @igBultos = (SELECT valIng.bultos FROM ingresoOperacionFiscal ingF INNER JOIN valoresIngOpFiscal valIng ON ingF.id = valIng.idIngreso AND ingF.id = @idIng)

DECLARE @chasisNuevos int
set @chasisNuevos = (SELECT count(*) FROM chasisVehiculosNuevos WHERE idIngreso = @idIng)


IF (@igBultos=@chasisNuevos)
BEGIN
SELECT 1 'resp';
END
ELSE
BEGIN
SELECT 0 'resp';

END

END


GO
/****** Object:  StoredProcedure [dbo].[spVerificaVehUs]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spVerificaVehUs]
@idDetalle int

AS
BEGIN
	SET NOCOUNT ON;

select count(*) AS 'vehiUSado' from detalleDeMercaderia
inner join vehiculosUsados ON vehiculosUsados.idDetalle = detalleDeMercaderia.id and detalleDeMercaderia.id = @idDetalle


END


GO
/****** Object:  StoredProcedure [dbo].[spVerifSerIn]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[spVerifSerIn]
@valor int
	AS
BEGIN
	SET NOCOUNT ON;



	SELECT srvC.servicio FROM ingresoOperacionFiscal ing
INNER JOIN servicios srvC ON ing.idServicio = srvC.id AND ing.id = @valor
END
GO
/****** Object:  StoredProcedure [dbo].[spVerMasRubros]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[spVerMasRubros]
@idCalculo INT
	AS
BEGIN
	SET NOCOUNT ON;
select servPre.id, servPre.idCalculo, servPre.idServicio, servPre.montoServicio, servPre.fechaRegistro,
servPre.estado, servPre.tipo, otrosServicios.otrosServicios, serviciosDefault.servicioDefault
from serviciosExtrasPrestados servPre
left join otrosServicios ON otrosServicios.id = servPre.idServicio
left join serviciosDefault ON serviciosDefault.id = servPre.idServicio
where idCalculo = @idCalculo
END
GO
/****** Object:  StoredProcedure [dbo].[spVerPolizaContable]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spVerPolizaContable]
@fecha date,
@idEmpresa int
	AS
BEGIN
	SET NOCOUNT ON;

DECLARE @inicioCorrelativo INT
SET @inicioCorrelativo = (SELECT numeroInicio FROM inicioCorrelativos)

SELECT
cuentasContables.cuenta, cuentasContables.nombreDeCuenta, polizasContaFiscal.monto, debeHaber.concepto 
, expConta.explicacion, numPoliza.numero + @inicioCorrelativo AS 'numPoliza', numPoliza.numero
FROM polizasContaFiscal
INNER JOIN cuentasContables ON polizasContaFiscal.idCuenta = cuentasContables.id
INNER JOIN debeHaber ON debeHaber.id =  polizasContaFiscal.idDebeHaber
INNER JOIN explicacionesContables expConta ON expConta.id = polizasContaFiscal.idExplicacion
INNER JOIN correaltivoPoliza numPoliza ON numPoliza.id = polizasContaFiscal.numeroPoliza
WHERE numPoliza.fecha LIKE @fecha AND idEmpresa = @idEmpresa
ORDER BY numPoliza.numero ASC, CAST(debeHaber.concepto AS VARCHAR) ASC

END
GO
/****** Object:  StoredProcedure [dbo].[spVerSaldAF]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[spVerSaldAF]
	@valor int

AS
BEGIN
	SET NOCOUNT ON;

SELECT * FROM inventarioFiscal WHERE idIngreso = @valor


END


GO
/****** Object:  StoredProcedure [dbo].[spVinculo]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO






CREATE PROCEDURE [dbo].[spVinculo]
	@idIngreso int,
	@tipoOperacion int,
	@idConsolidado int,
	@cadenaVinculo text,
	@estadoOp int

AS
BEGIN
	SET NOCOUNT ON;

INSERT INTO [dbo].[ingresosConsolidadoPoliza]
           ([idIngreso]
           ,[tipoOperacion]
           ,[idConsolidado]
           ,[cadenaVinculo]
		   ,[estadoOperacion])
     VALUES
           (@idIngreso
           ,@tipoOperacion
		   ,@idConsolidado
           ,@cadenaVinculo
		   ,@estadoOp)

END


GO
/****** Object:  StoredProcedure [dbo].[spVinculoCambio]    Script Date: 9/03/2021 19:53:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[spVinculoCambio]
	@idIng int,
	@idIngVinc int

AS
BEGIN
	SET NOCOUNT ON;

DECLARE @error int
BEGIN TRAN vinculosConsCambio
DECLARE @cadena varchar(40)
SET @cadena = (SELECT cadenaVinculo FROM ingresosConsolidadoPoliza WHERE idIngreso = @idIng)
UPDATE ingresosConsolidadoPoliza
SET cadenaVinculo = @cadena
WHERE idIngreso = @idIngVinc
END

SET @error = @@ERROR
IF (@error!=0)
BEGIN
ROLLBACK TRAN vinculosConsCambio
SELECT 0 'resp'
END
ELSE
BEGIN
COMMIT TRAN vinculosConsCambio
SELECT 1 'resp'
END

GO
