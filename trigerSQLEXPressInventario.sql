

USE [Integrada]
GO
/****** Object:  Trigger [dbo].[trActualizaInvConta]    Script Date: 3/3/2021 1:10:36 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TRIGGER [dbo].[trActualizaInvConta]
ON [dbo].[valoresIngOpFiscal] AFTER INSERT
AS
DECLARE @idIngreso int
SELECT @idIngreso = ins.idIngreso FROM INSERTED ins;
DECLARE @existe int
set @existe = (SELECT ISNULL(COUNT(*),0) from inventarioFiscal where idIngreso = @idIngreso)
IF (@existe=0)
BEGIN

DECLARE @bultos int
SELECT @bultos = ins.bultos FROM INSERTED ins;

DECLARE @peso float
SELECT @peso = ins.peso FROM INSERTED ins;

DECLARE @valorTotalAduana float
SELECT @valorTotalAduana = ins.valorTotalAduana FROM INSERTED ins;

DECLARE @totalValorCif float
SELECT @totalValorCif = ins.totalValorCif FROM INSERTED ins;

DECLARE @valorImpuesto float
SELECT @valorImpuesto = ins.valorImpuesto FROM INSERTED ins;

INSERT INTO [dbo].[inventarioFiscal] ([idIngreso], [saldoBultos], [pesoKg], [saldoValorTAduana], [saldoValorCif], [saldoValorImpuesto]) VALUES (@idIngreso, @bultos, @peso ,@valorTotalAduana, @totalValorCif, @valorImpuesto)

END